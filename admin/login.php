<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/bootstrap.php';
if (admin_user()) redirect(url('admin/index.php'));
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    if ((int) ($_SESSION['login_lock_until'] ?? 0) > time()) {
        $error = 'Too many attempts. Please wait one minute and try again.';
    } else {
        $statement = db()->prepare('SELECT * FROM users WHERE username = ? LIMIT 1');
        $statement->execute([trim((string) ($_POST['username'] ?? ''))]);
        $user = $statement->fetch();
        if ($user && password_verify((string) ($_POST['password'] ?? ''), $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['admin_user_id'] = (int) $user['id'];
            unset($_SESSION['login_attempts'], $_SESSION['login_lock_until']);
            db()->prepare('UPDATE users SET last_login_at = NOW() WHERE id = ?')->execute([$user['id']]);
            redirect(url($user['must_change_password'] ? 'admin/profile.php' : 'admin/index.php'));
        }
        $_SESSION['login_attempts'] = (int) ($_SESSION['login_attempts'] ?? 0) + 1;
        if ($_SESSION['login_attempts'] >= 5) { $_SESSION['login_lock_until'] = time() + 60; $_SESSION['login_attempts'] = 0; }
        $error = 'The username or password is incorrect.';
    }
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><meta name="robots" content="noindex,nofollow"><title>Admin Login | JG Cleaning Services</title><link rel="stylesheet" href="<?= e(asset('admin/assets/css/admin.css')) ?>"></head><body class="login-body"><div class="login-card"><a href="<?= e(url()) ?>"><img src="<?= e(asset((string) setting('logo_main'))) ?>" alt="JG Cleaning Services"></a><span class="login-card__label">Secure website administration</span><h1>Welcome back</h1><p>Sign in to manage pages, services, enquiries and website settings.</p><?php if ($error): ?><div class="admin-alert admin-alert--error"><?= e($error) ?></div><?php endif; ?><form method="post"><?= csrf_field() ?><label>Username<input type="text" name="username" autocomplete="username" required autofocus></label><label>Password<input type="password" name="password" autocomplete="current-password" required></label><button class="admin-button" type="submit">Sign in to CMS <span>→</span></button></form><a class="login-card__back" href="<?= e(url()) ?>">← Return to website</a></div></body></html>

