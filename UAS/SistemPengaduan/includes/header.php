<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($pageTitle ?? 'SIPMA') ?> - SIPMA</title>
<link rel="stylesheet" href="<?= $baseUrl ?? '' ?>assets/style.css">
</head>
<body>
<header class="topbar">
  <div class="brand">SIPMA<span>Sistem Informasi Pelayanan Pengaduan &amp; Aspirasi Masyarakat</span></div>
  <nav>
  <?php $u = currentUser(); ?>
  <?php if ($u): ?>
    <?php if ($u['role'] === 'admin'): ?>
      <a href="<?= $baseUrl ?? '' ?>admin/dashboard.php">Dashboard Admin</a>
    <?php else: ?>
      <a href="<?= $baseUrl ?? '' ?>user/dashboard.php">Laporan Saya</a>
      <a href="<?= $baseUrl ?? '' ?>user/create.php">Buat Laporan</a>
    <?php endif; ?>
    <span class="user-chip">Masuk sebagai <strong><?= e($u['username']) ?></strong> (<?= e($u['role']) ?>)</span>
    <a href="<?= $baseUrl ?? '' ?>logout.php" class="btn-logout">Keluar</a>
  <?php else: ?>
    <a href="<?= $baseUrl ?? '' ?>login.php">Masuk</a>
    <a href="<?= $baseUrl ?? '' ?>register.php">Daftar</a>
  <?php endif; ?>
  </nav>
</header>
<main class="container">
