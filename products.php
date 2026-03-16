<?php
$pageTitle = 'Our Luxury Vehicles';
$currentPage = 'products';
require_once __DIR__ . '/includes/product_repository.php';

$products = getAllProducts();
include __DIR__ . '/includes/header.php';
?>
    <section class="products">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Live Inventory</p>
                <h2>Our Collection</h2>
            </div>
            <p class="section-copy">Our products page is now connected to a PHP repository layer and ready for MySQL-backed inventory records.</p>
        </div>
        <div class="product-list">
            <?php foreach ($products as $product): ?>
                <article class="product-card">
                    <img src="<?= htmlspecialchars($product['image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                    <div class="product-meta">
                        <span class="product-badge"><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></span>
                        <span class="product-price"><?= htmlspecialchars(formatPrice((float) $product['price']), ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <h3><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($product['short_description'], ENT_QUOTES, 'UTF-8') ?></p>
                    <a class="text-link" href="product-details.php?id=<?= urlencode((string) $product['id']) ?>">View Details</a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php include __DIR__ . '/includes/footer.php'; ?>
