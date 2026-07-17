<?php
declare(strict_types=1);
require dirname(__DIR__) . '/lib/bootstrap.php';
unset($_SESSION['admin_user_id']);
session_regenerate_id(true);
flash('success', 'You have been signed out safely.');
redirect(url('admin/login.php'));
