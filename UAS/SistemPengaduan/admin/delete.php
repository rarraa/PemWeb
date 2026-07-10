<?php
require_once __DIR__ . '/../includes/init.php';
$baseurl = '../';
requireRole ('admin');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? null)) {
    $id = (int)($_POST['id'] ?? 0);
    $pdo->prepare('DELETE FROM laporan WHERE id = ?')->execute([$id]);
}
redirect('dashboard.php');