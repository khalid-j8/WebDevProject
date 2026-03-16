<?php

require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']) && (int) $_SESSION['user_id'] > 0;
}

function getCurrentUser(): ?array
{
    static $user = false;

    if ($user !== false) {
        return $user;
    }

    if (!isLoggedIn()) {
        $user = null;
        return $user;
    }

    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        $user = null;
        return $user;
    }

    $statement = $pdo->prepare('SELECT id, full_name, email, role, account_status, created_at FROM users WHERE id = :id LIMIT 1');
    $statement->execute(['id' => (int) $_SESSION['user_id']]);
    $record = $statement->fetch();

    if (!$record || $record['account_status'] !== 'active') {
        logoutUser();
        $user = null;
        return $user;
    }

    $user = $record;
    return $user;
}

function redirectTo(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function requireLogin(): array
{
    $user = getCurrentUser();

    if ($user === null) {
        redirectTo('login.php');
    }

    return $user;
}

function isAdmin(): bool
{
    $user = getCurrentUser();

    return $user !== null && $user['role'] === 'admin';
}

function requireAdmin(string $loginPath = 'login.php'): array
{
    $user = getCurrentUser();

    if ($user === null) {
        redirectTo($loginPath);
    }

    if ($user['role'] !== 'admin') {
        redirectTo('../dashboard.php');
    }

    return $user;
}

function findUserByEmail(string $email): ?array
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return null;
    }

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
    $statement->execute(['email' => strtolower(trim($email))]);
    $user = $statement->fetch();

    return $user ?: null;
}

function registerUser(string $fullName, string $email, string $password): array
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return [false, 'Database connection is not available.'];
    }

    $fullName = trim($fullName);
    $email = strtolower(trim($email));

    if ($fullName === '' || $email === '' || $password === '') {
        return [false, 'Please complete all required fields.'];
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return [false, 'Please enter a valid email address.'];
    }

    if (strlen($password) < 8) {
        return [false, 'Password must be at least 8 characters long.'];
    }

    if (findUserByEmail($email) !== null) {
        return [false, 'An account with that email already exists.'];
    }

    $statement = $pdo->prepare(
        'INSERT INTO users (full_name, email, password_hash, role, account_status) VALUES (:full_name, :email, :password_hash, :role, :account_status)'
    );

    $statement->execute([
        'full_name' => $fullName,
        'email' => $email,
        'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'user',
        'account_status' => 'active',
    ]);

    return [true, 'Your account has been created successfully.'];
}

function attemptLogin(string $email, string $password): array
{
    $user = findUserByEmail($email);

    if ($user === null || !password_verify($password, $user['password_hash'])) {
        return [false, 'Invalid email or password.'];
    }

    if ($user['account_status'] !== 'active') {
        return [false, 'Your account is currently disabled.'];
    }

    $_SESSION['user_id'] = (int) $user['id'];

    return [true, 'Login successful.'];
}

function logoutUser(): void
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    session_destroy();
}

function updateUserProfile(int $userId, string $fullName): array
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return [false, 'Database connection is not available.'];
    }

    $fullName = trim($fullName);

    if ($fullName === '') {
        return [false, 'Full name cannot be empty.'];
    }

    $statement = $pdo->prepare('UPDATE users SET full_name = :full_name WHERE id = :id');
    $statement->execute([
        'full_name' => $fullName,
        'id' => $userId,
    ]);

    return [true, 'Profile updated successfully.'];
}

function getAllUsers(): array
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return [];
    }

    $statement = $pdo->query('SELECT id, full_name, email, role, account_status, created_at FROM users ORDER BY created_at DESC');

    return $statement->fetchAll() ?: [];
}

function updateUserStatus(int $userId, string $status): array
{
    $pdo = getDatabaseConnection();

    if ($pdo === null) {
        return [false, 'Database connection is not available.'];
    }

    if (!in_array($status, ['active', 'disabled'], true)) {
        return [false, 'Invalid status selected.'];
    }

    $statement = $pdo->prepare('UPDATE users SET account_status = :status WHERE id = :id');
    $statement->execute([
        'status' => $status,
        'id' => $userId,
    ]);

    return [true, 'User account updated successfully.'];
}
