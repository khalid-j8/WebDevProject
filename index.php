<?php
$pageTitle = 'Home | Apex Motors';
$currentPage = 'home';
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/product_repository.php';
$products = getAllProducts();
?>

<!-- VIDEO HEROo -->
<section class="video-hero">
    <video autoplay muted loop playsinline class="hero-video">
        <source src="assets/videos/car.mp4" type="video/mp4">
    </video>

    <div class="video-overlay">
        <h2>Apex Motors</h2>
        <p class="eyebrow">Discover our exclusive collection of high-end vehicles, where sophistication meets performance.</p>

        <div class="hero-actions">
            <a href="products.php" class="cta-btn">Browse Vehicles</a>
            <a href="guide.php" class="secondary-btn">How It Works</a>
        </div>
    </div>
</section>

<!-- Featured vehicles section -->
<section class="featured-section">
    <h2>Featured Vehicles</h2>
    <p class="section-subtext">Explore some of our latest premium vehicles.</p>

    <div class="slider-wrapper">
        <button class="slider-btn left" onclick="scrollSlider(-1)">‹</button>

        <div class="car-slider" id="carSlider">
           <?php foreach (array_slice($products, 0, 19) as $product): ?>
                <div class="slide-card">
    <img src="<?= htmlspecialchars($product['image_url']) ?>" 
         alt="<?= htmlspecialchars($product['name']) ?>">

    <div class="slide-info">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p><?= htmlspecialchars(formatPrice((float)$product['price'])) ?></p>
        <a class="text-link" href="product-details.php?id=<?= urlencode((string)$product['id']) ?>">View Details</a>
    </div>
</div>
            <?php endforeach; ?>
        </div>

        <button class="slider-btn right" onclick="scrollSlider(1)">›</button>
    </div>
</section>

<!-- Why choose us section -->
 <section class="feature-flow">
    <span class="line-dot"></span>

    <div class="feature-row reveal left">
        <div class="feature-image">
            <img src="assets/images/img1.jpg" alt="Premium Vehicles">
        </div>

        <div class="feature-text info-card">
            <h3>Premium Selection</h3>
            <p>
                We handpick only the finest luxury vehicles for unmatched quality, performance, and design.
            </p>
        </div>
    </div>

    <div class="feature-row reverse reveal right">
        <div class="feature-image">
            <img src="assets/images/img2.jpg" alt="Financing Options">
        </div>

        <div class="feature-text info-card">
            <h3>Flexible Financing</h3>
            <p>
                Custom financing solutions tailored to your needs, making luxury more accessible.
            </p>
        </div>
    </div>

    <div class="feature-row reveal left">
        <div class="feature-image">
            <img src="assets/images/img3.jpg" alt="Delivery Service">
        </div>

        <div class="feature-text info-card">
            <h3>Nationwide Delivery</h3>
            <p>
                Get your vehicle delivered directly to your doorstep anywhere in the country.
            </p>
        </div>
    </div>


    <div class="feature-row reverse reveal right">
        <div class="feature-image">
            <img src="assets/images/img4.jpg" alt="Client Support">
        </div>

        <div class="feature-text info-card">
            <h3>White-Glove Service</h3>
            <p>
                Our team ensures a seamless experience from browsing to final delivery.
            </p>
        </div>
    </div>

</section>

<section class="cta-section">
    <div class="cta-box">
        <h2>Find Your Perfect Drive</h2>
        <p>Browse our curated collection of premium vehicles or speak with our team for a personalized experience.</p>

        <div class="cta-actions">
            <a href="products.php" class="cta-primary">Browse Vehicles</a>
            <a href="contact.php" class="cta-secondary">Contact Us</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>

<script>
function scrollSlider(direction) {
    const slider = document.getElementById("carSlider");
    const card = slider.querySelector(".slide-card");

    if (!card) return;

    const style = window.getComputedStyle(slider);
    const gap = parseInt(style.gap) || 0;

    const scrollAmount = card.offsetWidth + gap;

    slider.scrollBy({
        left: direction * scrollAmount,
        behavior: "smooth"
    });
}

const reveals = document.querySelectorAll('.reveal');

function handleScroll() {
    const trigger = window.innerHeight * 0.85;

    reveals.forEach(el => {
        const top = el.getBoundingClientRect().top;

        if (top < trigger) {
            el.classList.add('active');
        }
    });
}

window.addEventListener('scroll', handleScroll);
handleScroll();

const section = document.querySelector('.feature-flow');
const dot = document.querySelector('.line-dot');

window.addEventListener('scroll', () => {
    const rect = section.getBoundingClientRect();
    const scrolled = -rect.top;
    const total = section.offsetHeight - window.innerHeight;
    const progress = Math.min(Math.max(scrolled / total, 0), 1);
    const height = progress * section.offsetHeight;

    section.style.setProperty('--line-height', height + 'px');

    dot.style.top = height + 'px';
});

</script>