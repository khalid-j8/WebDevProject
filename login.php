<?php
require_once __DIR__ . '/includes/auth.php';

if (isLoggedIn()) {
    redirectTo('dashboard.php');
}

$pageTitle = 'Login | Luxury Vehicle Store';
$currentPage = '';
$feedback = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$success, $message] = attemptLogin($_POST['email'] ?? '', $_POST['password'] ?? '');
    $feedback = $message;

    if ($success) {
        redirectTo('dashboard.php');
    }
}

include __DIR__ . '/includes/header.php';
?>
    <main class="content-page">
        <section class="auth-layout">
            <div class="auth-panel">
                <p class="eyebrow">Sign In</p>
                <h2>Access your client dashboard.</h2>
                <p class="page-intro">Sign in to manage your account details and access the site’s growing private area.</p>

                <?php if ($feedback !== ''): ?>
                    <p class="form-message form-message-error"><?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endif; ?>

                <form class="auth-form" method="post" action="login.php">
                    <label>
                        Email Address
                        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Password
                        <input type="password" name="password" required>
                    </label>
                    <button type="submit" class="cta-btn">Sign In</button>
                </form>
            </div>
            <aside class="auth-side-card">
                <span class="section-tag">New Here?</span>
                <h3>Create your account in minutes.</h3>
                <p>Register for the private area to manage your profile and prepare for future saved-vehicle and booking features.</p>
                <a href="register.php" class="secondary-btn">Create an Account</a>
            </aside>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
