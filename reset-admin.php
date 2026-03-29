<?php
require_once __DIR__ . '/includes/db.php';

$pdo = getDatabaseConnection();
$hash = password_hash('Admin12345!', PASSWORD_DEFAULT);

$stmt = $pdo->prepare('UPDATE users SET password_hash = :hash WHERE email = :email');
$stmt->execute(['hash' => $hash, 'email' => 'admin@luxuryvehiclestore.com']);

echo 'Done! Hash: ' . $hash;