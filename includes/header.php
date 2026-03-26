<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/settings.php';

$pageTitle = $pageTitle ?? 'Luxury Vehicle Store';
$currentPage = $currentPage ?? '';
$currentUser = getCurrentUser();
$siteSettings = getSiteSettings();
$themeClass = $siteSettings['site_theme'] ?? 'theme-classic';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explore premium luxury vehicles, expert buying guidance, and client support from Luxury Vehicle Store.">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="<?= htmlspecialchars($themeClass, ENT_QUOTES, 'UTF-8') ?>">
    <header class="main-header">
        <h1>Luxury Vehicle Store</h1>
        <nav>
            <select id="ThemeSelect">
                <option value="light">Light</option>
                <option value="dark">Dark</option>
                <option value="luxe">Luxe</option>
                <option value="f1">F1</option>
            </select>
            <a href="index.php"<?= $currentPage === 'home' ? ' class="active"' : '' ?>>Home</a>
            <a href="about.php"<?= $currentPage === 'about' ? ' class="active"' : '' ?>>About</a>
            <a href="products.php"<?= $currentPage === 'products' ? ' class="active"' : '' ?>>View Products</a>
            <a href="faq.php"<?= $currentPage === 'faq' ? ' class="active"' : '' ?>>FAQ</a>
            <a href="contact.php"<?= $currentPage === 'contact' ? ' class="active"' : '' ?>>Contact</a>
            <a href="guide.php"<?= $currentPage === 'guide' ? ' class="active"' : '' ?>>Guide</a>
            <a href="privacy.php"<?= $currentPage === 'privacy' ? ' class="active"' : '' ?>>Privacy</a>
            <?php if ($currentUser !== null): ?>
                <a href="dashboard.php"<?= $currentPage === 'dashboard' ? ' class="active"' : '' ?>>Dashboard</a>
                <a href="profile.php"<?= $currentPage === 'profile' ? ' class="active"' : '' ?>>Profile</a>
                <?php if (isAdmin()): ?>
                    <a href="admin/dashboard.php">Admin</a>
                <?php endif; ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <script>
        const themeSelect = document.getElementById("ThemeSelect");
        const savedTheme = localStorage.getItem("site_theme") || "light";
        document.body.classList.add(`theme-${savedTheme}`);
        themeSelect.value = savedTheme;
        themeSelect.addEventListener("change", () => {
        document.body.classList.remove("theme-light", "theme-dark", "theme-luxe", "theme-f1");
        const newTheme = themeSelect.value;
        document.body.classList.add(`theme-${newTheme}`);
        localStorage.setItem("site_theme", newTheme);
});
</script>