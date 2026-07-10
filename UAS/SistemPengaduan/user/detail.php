<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('user');
$u = currentUser();
$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare('SELECT * FROM laporan WHERE id = ? AND user_id = ?');
$stmt->execute([$id, $u['id']]);
$laporan = $stmt->fetch();
if (!$laporan) {
    die('<p style="font-family:sans-serif;padding:2rem">Laporan tidak ditemukan.</p>');
}

$isi = decryptData($laporan['isi_laporan_enc']);

$tStmt = $pdo->prepare(
    'SELECT t.*, us.username AS admin_username FROM tanggapan t
     JOIN users us ON us.id = t.admin_id
     WHERE t.laporan_id = ? ORDER BY t.created_at ASC'
);
$tStmt->execute([$id]);
$tanggapanList = $tStmt->fetchAll();

$pageTitle = 'Detail Laporan';
include __DIR__ . '/../includes/header.php';
?>
<div class="card">
  <div class="detail-head">
    <h2><?= e($laporan['judul']) ?></h2>
    <span class="badge badge-<?= strtolower($laporan['status']) ?>"><?= e($laporan['status']) ?></span>
  </div>
  <p><strong>Kategori:</strong> <?= e($laporan['kategori']) ?></p>
  <p><strong>Tanggal Lapor:</strong> <?= formatTanggal($laporan['created_at']) ?></p>
  <p><strong>Mode:</strong> <?= $laporan['is_anonim'] ? 'Anonim' : 'Terbuka' ?></p>
  <div class="content-box">
    <strong>Isi Laporan:</strong>
    <p><?= nl2br(e($isi)) ?></p>
  </div>
</div>

<div class="card">
  <h3>Tanggapan &amp; Tindak Lanjut Petugas</h3>
  <?php if (empty($tanggapanList)): ?>
    <p class="empty-state">Belum ada tanggapan dari petugas.</p>
  <?php else: ?>
    <?php foreach ($tanggapanList as $t): ?>
      <div class="tanggapan-item">
        <p class="meta">Oleh Petugas: <?= e($t['admin_username']) ?> &middot; <?= formatTanggal($t['created_at']) ?></p>
        <p><?= nl2br(e($t['isi_tanggapan'])) ?></p>
      </div>
      <hr>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<a href="dashboard.php" class="btn">&laquo; Kembali ke Riwayat Laporan</a>
<?php include __DIR__ . '/../includes/footer.php'; ?>
