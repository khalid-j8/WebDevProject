<?php
require_once __DIR__ . '/includes/auth.php';

$user = requireLogin();
$pageTitle = 'Dashboard | Luxury Vehicle Store';
$currentPage = 'dashboard';
include __DIR__ . '/includes/header.php';
?>
    <main class="content-page">
        <section class="page-hero">
            <p class="eyebrow">Private Area</p>
            <h2>Welcome back, <?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8') ?>.</h2>
            <p class="page-intro">This dashboard is the foundation for the project’s private client area and will expand with bookings, saved vehicles, and account activity.</p>
        </section>

        <section class="dashboard-grid">
            <article class="content-card">
                <span class="section-tag">Account</span>
                <h3>Your profile is active</h3>
                <p>Email: <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Member since: <?= htmlspecialchars(date('F j, Y', strtotime($user['created_at'])), ENT_QUOTES, 'UTF-8') ?></p>
                <a href="profile.php" class="text-link">Manage profile</a>
            </article>
            <article class="content-card">
                <span class="section-tag">Next Feature</span>
                <h3>Saved vehicles and bookings</h3>
                <p>This private area is ready for future wishlist and booking features required by the larger project plan.</p>
                <a href="products.php" class="text-link">Browse inventory</a>
            </article>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
