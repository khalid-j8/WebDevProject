<?php
require_once __DIR__ . '/includes/auth.php';

$user = requireLogin();
$pageTitle = 'Profile | Luxury Vehicle Store';
$currentPage = 'profile';
$feedback = '';
$feedbackType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$success, $message] = updateUserProfile((int) $user['id'], $_POST['full_name'] ?? '');
    $feedback = $message;
    $feedbackType = $success ? 'success' : 'error';
    $user = requireLogin();
}

include __DIR__ . '/includes/header.php';
?>
    <main class="content-page">
        <section class="auth-layout">
            <div class="auth-panel">
                <p class="eyebrow">Profile Settings</p>
                <h2>Update your account information.</h2>
                <p class="page-intro">Keep your profile details current so the private area is ready for bookings and personalized support.</p>

                <?php if ($feedback !== ''): ?>
                    <p class="form-message <?= $feedbackType === 'success' ? 'form-message-success' : 'form-message-error' ?>">
                        <?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>

                <form class="auth-form" method="post" action="profile.php">
                    <label>
                        Full Name
                        <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Email Address
                        <input type="email" value="<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>" disabled>
                    </label>
                    <button type="submit" class="cta-btn">Save Changes</button>
                </form>
            </div>
            <aside class="auth-side-card">
                <span class="section-tag">Account Status</span>
                <h3><?= htmlspecialchars(ucfirst($user['account_status']), ENT_QUOTES, 'UTF-8') ?> member</h3>
                <p>Role: <?= htmlspecialchars(ucfirst($user['role']), ENT_QUOTES, 'UTF-8') ?></p>
                <p>Need to leave the private area? You can safely sign out at any time.</p>
                <a href="logout.php" class="secondary-btn">Sign Out</a>
            </aside>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
