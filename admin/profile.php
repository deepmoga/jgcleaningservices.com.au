<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/bootstrap.php';
$admin=require_admin();$adminTitle='My Profile';$adminSection='profile';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    verify_csrf();
    $name=trim((string)$_POST['name']);$email=trim((string)$_POST['email']);$current=(string)($_POST['current_password']??'');$new=(string)($_POST['new_password']??'');$confirm=(string)($_POST['confirm_password']??'');
    $stmt=db()->prepare('SELECT password_hash FROM users WHERE id=?');$stmt->execute([$admin['id']]);$hash=(string)$stmt->fetchColumn();
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))$error='Enter a valid email address.';
    elseif($new!==''&&!password_verify($current,$hash))$error='The current password is incorrect.';
    elseif($new!==''&&strlen($new)<12)$error='The new password must be at least 12 characters.';
    elseif($new!==$confirm)$error='The new password confirmation does not match.';
    else{if($new!==''){db()->prepare('UPDATE users SET name=?,email=?,password_hash=?,must_change_password=0 WHERE id=?')->execute([$name,$email,password_hash($new,PASSWORD_DEFAULT),$admin['id']]);}else{db()->prepare('UPDATE users SET name=?,email=? WHERE id=?')->execute([$name,$email,$admin['id']]);}flash('success','Your profile and security settings were updated.');redirect(url('admin/profile.php'));}
}
require __DIR__.'/includes/header.php';
?>
<div class="admin-page-head"><div><span>Account security</span><h2>Administrator profile</h2><p>Update your contact details and change the initial password.</p></div></div><?php if($admin['must_change_password']):?><div class="admin-alert admin-alert--warning"><strong>Password change required:</strong> replace the temporary password before continuing regular administration.</div><?php endif;?><?php if($error):?><div class="admin-alert admin-alert--error"><?= e($error) ?></div><?php endif;?>
<form class="admin-form profile-form" method="post"><?= csrf_field() ?><section class="admin-panel"><div class="admin-panel__head"><div><span>Profile</span><h2>Personal details</h2></div></div><div class="admin-form-grid"><label>Your name<input type="text" name="name" value="<?= e($admin['name']) ?>" required></label><label>Email address<input type="email" name="email" value="<?= e($admin['email']) ?>" required></label></div></section><section class="admin-panel"><div class="admin-panel__head"><div><span>Security</span><h2>Change password</h2></div><small>Use at least 12 characters</small></div><div class="admin-form-grid"><label class="full">Current password<input type="password" name="current_password" autocomplete="current-password"></label><label>New password<input type="password" name="new_password" autocomplete="new-password"></label><label>Confirm new password<input type="password" name="confirm_password" autocomplete="new-password"></label></div></section><div class="admin-form-actions"><a href="<?= e(url('admin/index.php')) ?>">Cancel</a><button class="admin-button" type="submit">Update profile</button></div></form>
<?php require __DIR__.'/includes/footer.php';?>
