<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/product_repository.php';

requireAdmin('login.php');
$productId = isset($_GET['id']) ? (int) $_GET['id'] : (int) ($_POST['id'] ?? 0);
$product = $productId > 0 ? getProductById($productId) : null;
$pageTitle = 'Edit Product | Luxury Vehicle Store';
$currentAdminPage = 'products';
$feedback = '';
$feedbackType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product !== null) {
    [$success, $message] = updateProduct($_POST);
    $feedback = $message;
    $feedbackType = $success ? 'success' : 'error';
    $product = getProductById($productId);
}

include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <?php if ($product === null): ?>
            <section class="page-hero">
                <p class="eyebrow">Admin Inventory</p>
                <h2>Product not found.</h2>
                <a href="products.php" class="cta-btn">Back to Products</a>
            </section>
        <?php else: ?>
            <section class="auth-layout admin-edit-layout">
                <div class="auth-panel">
                    <p class="eyebrow">Edit Product</p>
                    <h2><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                    <?php if ($feedback !== ''): ?>
                        <p class="form-message <?= $feedbackType === 'success' ? 'form-message-success' : 'form-message-error' ?>">
                            <?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    <?php endif; ?>
                    <form class="auth-form admin-form-grid" method="post" action="product-edit.php?id=<?= urlencode((string) $product['id']) ?>">
                        <input type="hidden" name="id" value="<?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?>">
                        <label>Name<input type="text" name="name" value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Category<input type="text" name="category" value="<?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Model Year<input type="number" name="model_year" value="<?= htmlspecialchars((string) $product['model_year'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Price<input type="number" step="0.01" name="price" value="<?= htmlspecialchars((string) $product['price'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Engine<input type="text" name="engine" value="<?= htmlspecialchars($product['engine'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Horsepower<input type="number" name="horsepower" value="<?= htmlspecialchars((string) $product['horsepower'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Transmission<input type="text" name="transmission" value="<?= htmlspecialchars($product['transmission'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Drivetrain<input type="text" name="drivetrain" value="<?= htmlspecialchars($product['drivetrain'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Seats<input type="number" name="seats" value="<?= htmlspecialchars((string) $product['seats'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Exterior Color<input type="text" name="exterior_color" value="<?= htmlspecialchars($product['exterior_color'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Interior Color<input type="text" name="interior_color" value="<?= htmlspecialchars($product['interior_color'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label>Image URL<input type="url" name="image_url" value="<?= htmlspecialchars($product['image_url'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label class="admin-form-full">Short Description<input type="text" name="short_description" value="<?= htmlspecialchars($product['short_description'], ENT_QUOTES, 'UTF-8') ?>" required></label>
                        <label class="admin-form-full">Full Description<textarea name="full_description" required><?= htmlspecialchars($product['full_description'], ENT_QUOTES, 'UTF-8') ?></textarea></label>
                        <label class="checkbox-label admin-form-full">
                            <input type="checkbox" name="featured" value="1"<?= !empty($product['featured']) ? ' checked' : '' ?>>
                            Featured product
                        </label>
                        <button type="submit" class="cta-btn admin-form-full">Save Product</button>
                    </form>
                </div>
                <aside class="auth-side-card">
                    <span class="section-tag">Quick Links</span>
                    <h3>Inventory actions</h3>
                    <p>Use this simple editor to satisfy the admin data-editing requirement without adding a full CMS.</p>
                    <a href="../product-details.php?id=<?= urlencode((string) $product['id']) ?>" class="secondary-btn">View public page</a>
                </aside>
            </section>
        <?php endif; ?>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
