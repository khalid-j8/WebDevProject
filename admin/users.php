<?php
require_once __DIR__ . '/../includes/auth.php';

$admin = requireAdmin('login.php');
$pageTitle = 'Admin Users | Luxury Vehicle Store';
$currentAdminPage = 'users';
$feedback = '';
$feedbackType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetUserId = (int) ($_POST['user_id'] ?? 0);
    $targetStatus = $_POST['account_status'] ?? '';

    if ($targetUserId === (int) $admin['id'] && $targetStatus === 'disabled') {
        $feedback = 'You cannot disable the admin account currently in use.';
        $feedbackType = 'error';
    } else {
        [$success, $message] = updateUserStatus($targetUserId, $targetStatus);
        $feedback = $message;
        $feedbackType = $success ? 'success' : 'error';
    }
}

$users = getAllUsers();
include __DIR__ . '/header.php';
?>
    <main class="content-page">
        <section class="section-heading admin-section-heading">
            <div>
                <p class="eyebrow">Admin Accounts</p>
                <h2>Manage Users</h2>
            </div>
            <p class="section-copy">Enable or disable user access from one simple control screen.</p>
        </section>

        <?php if ($feedback !== ''): ?>
            <section class="admin-table-wrap admin-feedback-wrap">
                <p class="form-message <?= $feedbackType === 'success' ? 'form-message-success' : 'form-message-error' ?>">
                    <?= htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8') ?>
                </p>
            </section>
        <?php endif; ?>

        <section class="admin-table-wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Change</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['full_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars(ucfirst($user['role']), ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars(ucfirst($user['account_status']), ENT_QUOTES, 'UTF-8') ?></td>
                            <td>
                                <form class="inline-admin-form" method="post" action="users.php">
                                    <input type="hidden" name="user_id" value="<?= htmlspecialchars((string) $user['id'], ENT_QUOTES, 'UTF-8') ?>">
                                    <select name="account_status">
                                        <option value="active"<?= $user['account_status'] === 'active' ? ' selected' : '' ?>>Active</option>
                                        <option value="disabled"<?= $user['account_status'] === 'disabled' ? ' selected' : '' ?>>Disabled</option>
                                    </select>
                                    <button type="submit" class="secondary-btn">Save</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
<?php include __DIR__ . '/footer.php'; ?>
