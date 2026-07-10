<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('admin');

$statusFilter = $_GET['status'] ?? '';
$sql = 'SELECT l.*, us.username FROM laporan l JOIN users us ON us.id = l.user_id';
$params = [];
if (in_array($statusFilter, ['Pending', 'Proses', 'Selesai'], true)) {
    $sql .= ' WHERE l.status = ?';
    $params[] = $statusFilter;
}
$sql .= ' ORDER BY l.created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$laporanList = $stmt->fetchAll();

$pageTitle = 'Dashboard Admin';
include __DIR__ . '/../includes/header.php';
?>
<div class="page-head">
  <h2>Semua Laporan Masyarakat</h2>
</div>
<div class="filter-bar"> 
  <a href="dashboard.php" class="btn btn-sm <?= $statusFilter === '' ? 'btn-active' : '' ?>">Semua</a>  
  <a href="dashboard.php?status=Pending" class="btn btn-sm <?= $statusFilter === 'Pending' ? 'btn-active' : '' ?>">Pending</a>  
  <a href="dashboard.php?status=Proses" class="btn btn-sm <?= $statusFilter === 'Proses' ? 'btn-active' : '' ?>">Proses</a>
  <a href="dashboard.php?status=Selesai" class="btn btn-sm <?= $statusFilter === 'Selesai' ? 'btn-active' : '' ?>">Selesai</a>
</div>

<?php if (empty($laporanList)): ?> 
  <p class="empty-state">Tidak ada laporan untuk filter ini.</p> 
<?php else: ?>
<table class="table"> 
  <thead>
    <tr><th>Judul</th><th>Kategori</th><th>Pelapor</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
  </thead>
  <tbody>
  <?php foreach ($laporanList as $l): ?>
    <tr class="<?= $l['is_flagged'] ? 'row-flagged' : '' ?>">
      <td>
        <?= e($l['judul']) ?> 
        <?php if ($l['is_flagged']): ?><span class="tag-warning">Terindikasi Spam / Kata Kasar</span><?php endif; ?>
      </td>
      <td><?= e($l['kategori']) ?></td> 
      <td><?= $l['is_anonim'] ? '<em>Anonim</em>' : e($l['username']) ?></td> 
      <td><span class="badge badge-<?= strtolower($l['status']) ?>"><?= e($l['status']) ?></span></td> 
      <td><?= formatTanggal($l['created_at']) ?></td> 
      <td class="actions">
        <a href="detail.php?id=<?= (int)$l['id'] ?>" class="btn btn-sm">Kelola</a>
        <form method="post" action="delete.php" class="inline-form" onsubmit="return confirm('Hapus laporan ini secara permanen? Tindakan ini tidak dapat dibatalkan.');">
          <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
          <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>
