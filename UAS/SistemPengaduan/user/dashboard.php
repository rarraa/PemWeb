<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('user');
$u = currentUser();
$stmt = $pdo->prepare('SELECT * FROM laporan WHERE user_id = ? ORDER By created_at DESC');
$stmt->execute([$u['id']]);
$laporanList = $stmt->fetchAll();
$pageTitle = 'Laporan Saya';
include __DIR__ . '/../includes/header.php';
?>
<div class="page-head">
  <h2>Riwayat Laporan Saya</h2>
  <a href="create.php" class="btn btn-primary" style="margin-top:0">+ Buat Laporan Baru</a>
</div>

<?php if (empty($laporanList)): ?>
  <p class="empty-state">Anda belum membuat laporan apa pun.</p>
<?php else: ?>
<table class="table">
  <thead>
    <tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal</th><th>Aksi</th></tr>
  </thead>
  <tbody>
  <?php foreach ($laporanList as $l): ?>
    <tr>
      <td><?= e($l['judul']) ?></td>
      <td><?= e($l['kategori']) ?></td>
      <td><span class="badge badge-<?= strtolower($l['status']) ?>"><?= e($l['status']) ?></span></td>
      <td><?= formatTanggal($l['created_at']) ?></td>
      <td class="actions">
        <a href="detail.php?id=<?= (int)$l['id'] ?>" class="btn btn-sm">Lihat</a>
        <?php if ($l['status'] === 'Pending'): ?>
          <a href="edit.php?id=<?= (int)$l['id'] ?>" class="btn btn-sm">Edit</a>
          <form method="post" action="delete.php" class="inline-form" onsubmit="return confirm('Hapus laporan ini?');">
            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
            <input type="hidden" name="id" value="<?= (int)$l['id'] ?>">
            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
          </form>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>
<?php include __DIR__ . '/../includes/footer.php'; ?>