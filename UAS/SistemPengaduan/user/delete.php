<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('user');
$u = currentUser();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? null)) {
    $id = (int)($_POST['id'] ?? 0);
    $del = $pdo->prepare('DELETE FROM laporan WHERE id = ? AND user_id = ? AND status = "Pending"');
    $del->execute([$id, $u['id']]);
}
redirect('dashboard.php');
