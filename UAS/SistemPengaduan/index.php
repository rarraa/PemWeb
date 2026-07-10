<?php
require_once __DIR__ . '/includes/init.php';
$baseUrl = '';

$u = currentUser();
if (!$u) {
    redirect('login.php');
}
redirect($u['role'] === 'admin' ? 'admin/dashboard.php' : 'user/dashboard.php');