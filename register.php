<?php
require_once __DIR__ . '/includes/auth.php';

if (isLoggedIn()) {
    redirectTo('dashboard.php');
}

$pageTitle = 'Register | Luxury Vehicle Store';
$currentPage = '';
$feedback = '';
$feedbackType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$success, $message] = registerUser(
        $_POST['full_name'] ?? '',
        $_POST['email'] ?? '',
        $_POST['password'] ?? ''
    );

    $feedback = $message;
    $feedbackType = $success ? 'success' : 'error';

    if ($success) {
        [$loggedIn] = attemptLogin($_POST['email'] ?? '', $_POST['password'] ?? '');
        if ($loggedIn) {
            redirectTo('dashboard.php');
        }
    }
}

include __DIR__ . '/includes/header.php';
?>
    <main class="content-page">
        <section class="auth-layout">
            <div class="auth-panel">
                <p class="eyebrow">Create Account</p>
                <h2>Join the private client area.</h2>
                <p class="page-intro">Register to manage your profile, save vehicles, and prepare for future private dashboard features.</p>

                <?php if ($feedback !== ''): ?>
                    <p class="form-message <?= $feedbackType === 'success' ? 'form-message-success' : 'form-message-error' ?>">
                        <?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?>
                    </p>
                <?php endif; ?>

                <form class="auth-form" method="post" action="register.php">
                    <label>
                        Full Name
                        <input type="text" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Email Address
                        <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    </label>
                    <label>
                        Password
                        <input type="password" name="password" minlength="8" required>
                    </label>
                    <button type="submit" class="cta-btn">Create Account</button>
                </form>
            </div>
            <aside class="auth-side-card">
                <span class="section-tag">Private Area</span>
                <h3>What your account unlocks</h3>
                <p>Access your dashboard, manage profile details, and prepare for saved vehicles and booking tools as the project grows.</p>
                <a href="login.php" class="secondary-btn">Already have an account?</a>
            </aside>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>
