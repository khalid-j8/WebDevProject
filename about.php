<!-- almost completed About us page, updated March18th   
 - Taha -->

<?php
$pageTitle = 'About Us | Luxury Vehicle Store';
$currentPage = 'about';
include __DIR__ . '/includes/header.php';
?>

<main class="content-page">

    <!-- HERO -->
    <section class="page-hero">
        <p class="eyebrow">About Our Brand</p>
        <h2>Luxury vehicles presented with modern service and trusted guidance.</h2>
        <p class="page-intro">
            Luxury Vehicle Store connects drivers with premium vehicles, transparent expertise,
            and a smooth buying experience from start to finish.
        </p>
    </section>




    <!-- COMPANY STORY -->
    <section class="content-grid">
        <article class="content-card">
            <span class="section-tag">Who We Are</span>
            <h3>A dealership built on trust and quality.</h3>
            <p>
                We specialize in high-end vehicles designed for performance, comfort, and style.
                Our team focuses on providing honest advice, premium inventory, and a stress-free
                purchasing experience.
            </p>
        </article>

        <article class="content-card">
            <span class="section-tag">Why Choose Us</span>
            <h3>Customer-first experience.</h3>
            <p>
                From browsing to delivery, we prioritize transparency, quality, and satisfaction.
                Every vehicle is carefully selected to meet the highest standards.
            </p>
        </article>
    </section>

    <!-- IMAGES , in out slider-->
    <section class="slider-container">
        <div class="slider">
            <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70">
            <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7">
            <img src="https://images.unsplash.com/photo-1511919884226-fd3cad34687c">
        </div>

        <!-- DOTS -->
        <div class="slider-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </section>

    <!-- MAP -->
    <section class="content-card" style="margin-top: 30px;">
        <span class="section-tag">Visit Us</span>
        <h3>Our Location</h3>

        <iframe
            src="https://www.google.com/maps?q=401+Sunset+Ave+Windsor+ON&output=embed"
            width="100%"
            height="400"
            style="border:0; border-radius:10px;"
            allowfullscreen=""
            loading="lazy">
        </iframe>
    </section>

</main>

<?php include __DIR__ . '/includes/footer.php'; ?>
