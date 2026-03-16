<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/product_repository.php';

requireAdmin('login.php');
$pageTitle = 'Admin Products | Luxury Vehicle Store';
$currentAdminPage = 'products';
$products = getAllProducts();
include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <section class="section-heading admin-section-heading">
            <div>
                <p class="eyebrow">Admin Inventory</p>
                <h2>Manage Products</h2>
            </div>
            <p class="section-copy">Edit core product fields directly from the admin area.</p>
        </section>

        <section class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?= htmlspecialchars((string) $product['id'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($product['category'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars(formatPrice((float) $product['price']), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><a class="text-link" href="product-edit.php?id=<?= urlencode((string) $product['id']) ?>">Edit</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
