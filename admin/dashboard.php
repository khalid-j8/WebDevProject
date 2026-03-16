<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/product_repository.php';
require_once __DIR__ . '/../includes/settings.php';

$admin = requireAdmin('login.php');
$pageTitle = 'Admin Dashboard | Luxury Vehicle Store';
$currentAdminPage = 'dashboard';
$products = getAllProducts();
$users = getAllUsers();
$siteSettings = getSiteSettings();
include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <section class="page-hero">
            <p class="eyebrow">Admin Dashboard</p>
            <h2>Simple controls for inventory and user access.</h2>
            <p class="page-intro">Signed in as <?= htmlspecialchars($admin['full_name'], ENT_QUOTES, 'UTF-8') ?>. Use these admin pages to edit product records and manage account access.</p>
        </section>

        <section class="dashboard-grid">
            <article class="content-card">
                <span class="section-tag">Inventory</span>
                <h3><?= htmlspecialchars((string) count($products), ENT_QUOTES, 'UTF-8') ?> products</h3>
                <p>The live inventory is database-backed and ready for updates.</p>
                <a href="products.php" class="text-link">Manage products</a>
            </article>
            <article class="content-card">
                <span class="section-tag">Accounts</span>
                <h3><?= htmlspecialchars((string) count($users), ENT_QUOTES, 'UTF-8') ?> users</h3>
                <p>Enable or disable user accounts with a simple admin action.</p>
                <a href="users.php" class="text-link">Manage users</a>
            </article>
            <article class="content-card">
                <span class="section-tag">Template</span>
                <h3><?= htmlspecialchars(getThemeOptions()[$siteSettings['site_theme']]['name'] ?? 'Classic Light', ENT_QUOTES, 'UTF-8') ?></h3>
                <p>Switch between three site looks from one simple setting.</p>
                <a href="templates.php" class="text-link">Change template</a>
            </article>
            <article class="content-card">
                <span class="section-tag">Monitoring</span>
                <h3>System status view</h3>
                <p>See whether the database, auth layer, and inventory services are responding.</p>
                <a href="monitoring.php" class="text-link">Open monitoring</a>
            </article>
        </section>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
