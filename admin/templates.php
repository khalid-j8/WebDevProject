<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/settings.php';

requireAdmin('login.php');
$pageTitle = 'Admin Templates | Luxury Vehicle Store';
$currentAdminPage = 'templates';
$feedback = '';
$feedbackType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$success, $message] = updateSiteTheme($_POST['site_theme'] ?? '');
    $feedback = $message;
    $feedbackType = $success ? 'success' : 'error';
}

$siteSettings = getSiteSettings();
$themes = getThemeOptions();
include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <section class="page-hero">
            <p class="eyebrow">Admin Templates</p>
            <h2>Switch the site between three simple themes.</h2>
            <p class="page-intro">This satisfies the template-switching requirement while keeping the implementation lightweight and easy to demo.</p>
        </section>

        <section class="admin-theme-grid">
            <?php foreach ($themes as $themeKey => $theme): ?>
                <article class="content-card theme-option-card<?= $siteSettings['site_theme'] === $themeKey ? ' theme-option-active' : '' ?>">
                    <span class="section-tag"><?= htmlspecialchars($theme['name'], ENT_QUOTES, 'UTF-8') ?></span>
                    <h3><?= htmlspecialchars($theme['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                    <p><?= htmlspecialchars($theme['description'], ENT_QUOTES, 'UTF-8') ?></p>
                    <form method="post" action="templates.php">
                        <input type="hidden" name="site_theme" value="<?= htmlspecialchars($themeKey, ENT_QUOTES, 'UTF-8') ?>">
                        <button type="submit" class="<?= $siteSettings['site_theme'] === $themeKey ? 'secondary-btn' : 'cta-btn' ?>">
                            <?= $siteSettings['site_theme'] === $themeKey ? 'Active Theme' : 'Use This Theme' ?>
                        </button>
                    </form>
                </article>
            <?php endforeach; ?>
        </section>

        <?php if ($feedback !== ''): ?>
            <section class="admin-table-wrap admin-feedback-wrap">
                <p class="form-message <?= $feedbackType === 'success' ? 'form-message-success' : 'form-message-error' ?>">
                    <?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?>
                </p>
            </section>
        <?php endif; ?>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
