<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/product_repository.php';
require_once __DIR__ . '/../includes/settings.php';

requireAdmin('login.php');
$pageTitle = 'Admin Monitoring | Luxury Vehicle Store';
$currentAdminPage = 'monitoring';

$databaseOnline = getDatabaseConnection() !== null;
$productCount = count(getAllProducts());
$userCount = count(getAllUsers());
$themeName = getThemeOptions()[getSiteSettings()['site_theme']]['name'] ?? 'Classic Light';

$services = [
    [
        'name' => 'Website Frontend',
        'status' => 'Online',
        'detail' => 'Public PHP pages are available.',
    ],
    [
        'name' => 'Database',
        'status' => $databaseOnline ? 'Online' : 'Offline',
        'detail' => $databaseOnline ? 'MySQL connection is responding.' : 'Database connection is unavailable.',
    ],
    [
        'name' => 'Inventory Service',
        'status' => $productCount > 0 ? 'Online' : 'Warning',
        'detail' => $productCount . ' products are available to the site.',
    ],
    [
        'name' => 'Authentication',
        'status' => $userCount > 0 ? 'Online' : 'Warning',
        'detail' => $userCount . ' user account(s) detected.',
    ],
    [
        'name' => 'Template Service',
        'status' => 'Online',
        'detail' => 'Current template: ' . $themeName . '.',
    ],
];

include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <section class="page-hero">
            <p class="eyebrow">Admin Monitoring</p>
            <h2>Simple status reporting for core website services.</h2>
            <p class="page-intro">This page gives a lightweight health snapshot of the site, database, auth layer, and template setting.</p>
        </section>

        <section class="monitor-grid">
            <?php foreach ($services as $service): ?>
                <article class="content-card monitor-card">
                    <span class="monitor-status monitor-status-<?= strtolower($service['status']) ?>">
                        <?= htmlspecialchars($service['status'], ENT_QUOTES, 'UTF-8') ?>
                    </span>
                    <h3><?= htmlspecialchars($service['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($service['detail'], ENT_QUOTES, 'UTF-8') ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
