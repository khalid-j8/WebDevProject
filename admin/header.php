<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/settings.php';

$pageTitle = $pageTitle ?? 'Admin | Luxury Vehicle Store';
$currentAdminPage = $currentAdminPage ?? '';
$siteSettings = getSiteSettings();
$themeClass = $siteSettings['site_theme'] ?? 'theme-classic';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body class="<?= htmlspecialchars($themeClass, ENT_QUOTES, 'UTF-8') ?>">
    <header class="main-header">
        <h1>Admin Panel</h1>
        <nav>
            <a href="../index.php">Public Site</a>
            <a href="dashboard.php"<?= $currentAdminPage === 'dashboard' ? ' class="active"' : '' ?>>Dashboard</a>
            <a href="products.php"<?= $currentAdminPage === 'products' ? ' class="active"' : '' ?>>Products</a>
            <a href="users.php"<?= $currentAdminPage === 'users' ? ' class="active"' : '' ?>>Users</a>
            <a href="templates.php"<?= $currentAdminPage === 'templates' ? ' class="active"' : '' ?>>Templates</a>
            <a href="monitoring.php"<?= $currentAdminPage === 'monitoring' ? ' class="active"' : '' ?>>Monitoring</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </header>
