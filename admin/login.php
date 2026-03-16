<?php
require_once __DIR__ . '/../includes/auth.php';

if (isAdmin()) {
    redirectTo('dashboard.php');
}

$pageTitle = 'Admin Login | Luxury Vehicle Store';
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$success, $message] = attemptLogin($_POST['email'] ?? '', $_POST['password'] ?? '');
    $feedback = $message;

    if ($success && isAdmin()) {
        redirectTo('dashboard.php');
    }

    if ($success) {
        $feedback = 'This account is not an admin account.';
        logoutUser();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <main class="content-page">
        <section class="auth-layout">
            <div class="auth-panel">
                <p class="eyebrow">Admin Access</p>
                <h2>Sign in to manage the website.</h2>
                <p class="page-intro">This area is restricted to administrator accounts only.</p>
                <?php if ($feedback !== ''): ?>
                    <p class="form-message form-message-error"><?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>
                <form class="auth-form" method="post" action="login.php">
                    <label>
                        Email Address
                        <input type="email" name="email" required>
                    </label>
                    <label>
                        Password
                        <input type="password" name="password" required>
                    </label>
                    <button type="submit" class="cta-btn">Admin Login</button>
                </form>
            </div>
            <aside class="auth-side-card">
                <span class="section-tag">Seeded Admin</span>
                <h3>Quick local test access</h3>
                <p>Email: admin@luxuryvehiclestore.com</p>
                <p>Password: Admin12345!</p>
            </aside>
        </section>
    </main>
</body>
</html>
