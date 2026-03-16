<?php
$pageTitle = 'Luxury Vehicle Store';
$currentPage = 'home';
include __DIR__ . '/includes/header.php';
?>
    <section class="hero">
        <p class="eyebrow">Luxury, Refined</p>
        <h2>Experience the Pinnacle of Automotive Luxury</h2>
        <p>Discover our exclusive collection of high-end vehicles, where sophistication meets performance.</p>
        <div class="hero-actions">
            <a href="products.php" class="cta-btn">Browse Vehicles</a>
            <a href="guide.php" class="secondary-btn">How It Works</a>
        </div>
    </section>

    <section class="info-section">
        <div class="info-card">
            <span class="section-tag">Curated Collection</span>
            <h3>Handpicked premium vehicles built to impress.</h3>
            <p>Explore luxury sedans, SUVs, and performance coupes selected for design, comfort, and presence.</p>
        </div>
        <div class="info-card">
            <span class="section-tag">Client Support</span>
            <h3>A streamlined buying experience from inquiry to delivery.</h3>
            <p>We help with reservations, financing guidance, customization requests, and nationwide vehicle delivery.</p>
        </div>
    </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
