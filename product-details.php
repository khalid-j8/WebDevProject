<?php
require_once __DIR__ . '/includes/product_repository.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$product = $productId > 0 ? getProductById($productId) : null;
$pageTitle = $product ? $product['name'] . ' | Luxury Vehicle Store' : 'Product Details | Luxury Vehicle Store';
$currentPage = 'products';
include __DIR__ . '/includes/header.php';
?>
    <main class="content-page">
        <?php if ($product === null): ?>
            <section class="page-hero">
                <p class="eyebrow">Vehicle Not Found</p>
                <h2>We could not find the product you requested.</h2>
                <p class="page-intro">Return to the collection to continue exploring our available inventory.</p>
                <a href="products.php" class="cta-btn">Back to Products</a>
            </section>
        <?php else: ?>
            <section class="detail-layout">
                <div class="detail-media">
                    <img src="<?= htmlspecialchars($product['image_url'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>">
                </div>
                <div class="detail-panel">
                    <p class="eyebrow"><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></p>
                    <h2><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <p class="detail-price"><?= htmlspecialchars(formatPrice((float) $product['price']), ENT_QUOTES, 'UTF-8') ?></p>
                    <p class="page-intro"><?= htmlspecialchars($product['full_description'], ENT_QUOTES, 'UTF-8') ?></p>

                    <div class="detail-specs">
                        <div class="spec-card">
                            <span class="section-tag">Performance</span>
                            <h3><?= htmlspecialchars((string) $product['horsepower'], ENT_QUOTES, 'UTF-8') ?> HP</h3>
                            <p><?= htmlspecialchars($product['engine'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="spec-card">
                            <span class="section-tag">Configuration</span>
                            <h3><?= htmlspecialchars($product['drivetrain'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><?= htmlspecialchars($product['transmission'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>

                    <div class="detail-facts">
                        <div><strong>Exterior:</strong> <?= htmlspecialchars($product['exterior_color'], ENT_QUOTES, 'UTF-8') ?></div>
                        <div><strong>Interior:</strong> <?= htmlspecialchars($product['interior_color'], ENT_QUOTES, 'UTF-8') ?></div>
                        <div><strong>Seats:</strong> <?= htmlspecialchars((string) $product['seats'], ENT_QUOTES, 'UTF-8') ?></div>
                        <div><strong>Model Year:</strong> <?= htmlspecialchars((string) $product['model_year'], ENT_QUOTES, 'UTF-8') ?></div>
                    </div>

                    <div class="hero-actions detail-actions">
                        <a href="contact.php" class="cta-btn">Book an Inquiry</a>
                        <a href="products.php" class="secondary-btn">Back to Inventory</a>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
