<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('admin');
$admin = currentUser();
$id = (int)($_GET['id'] ?? $_POST['laporan_id'] ?? 0);

$stmt = $pdo->prepare(
    'SELECT l.*, us.username, us.nama_enc, us.nik_enc FROM laporan l
    JOIN users us ON us.id = l.user_id WHERE l.id = ?'
);
$stmt->execute([$id]);
$laporan = $stmt->fetch();
if (!$laporan) {
    die('<p style="font-family:sans-serif;padding:2rem">Laporan tidak ditemukan.</p>');
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? null)) {
    $action = $_POST['action'] ?? '';
    if ($action === 'update_status') {
        $newStatus = $_POST['status'] ?? '';
        if (in_array($newStatus, ['Pending', 'Proses', 'Selesai'], true)) {
            $pdo->prepare('UPDATE laporan SET status = ? WHERE id = ?')->execute([$newStatus, $id]);
            $laporan['status'] = $newStatus;
            $message = 'Status laporan berhasil diperbaharui.';
        }
    } elseif ($action === 'add_tanggapan') {
        $isi = trim($_POST['isi_tanggapan'] ?? '');
        if ($isi !== '') {
            $pdo->prepare('INSERT INTO tanggapan (laporan_id, admin_id, isi_tanggapan) VALUES (?, ?, ?)')
                ->execute([$id, $admin['id'], $isi]);
            if ($laporan['status'] === 'Pending') {
                $pdo->prepare('UPDATE laporan SET status = "Proses" WHERE id = ?')->execute([$id]);
                $laporan['status'] = 'Proses';
            }
            $message = 'Tanggapan berhasil ditambahkan.';
        }
    } elseif ($action === 'edit_tanggapan') {
        $tId = (int)($_POST['tanggapan_id'] ?? 0);
        $isi = trim($_POST['isi_tangapan'] ?? '');
        if ($isi !== '') {
            $pdo->prepare('UPDATE tanggapan SET isi_tanggapan = ? WHERE id = ? AND laporan_id = ?')
                ->execute([$isi, $tId, $id]);
            $message = 'Tanggapan berhasil diperbaharui.';
        }
    } elseif ($action === 'delete_tanggapan') {
        $tId = (int)($_POST['tanggapan_id'] ?? 0);
        $pdo->prepare('DELETE FROM tanggapan WHERE id = ? AND laporan_id = ?')->execute([$tId, $id]);
        $message = 'Tanggapan berhasil dihapus.';
    }
}

$isiDecrypted = decryptData($laporan['isi_laporan_enc']);
$namaPelapor = $laporan['is_anonim'] ? null : decryptData($laporan['nama_enc']);
$nikPelapor  = $laporan['is_anonim'] ? null : decryptData($laporan['nik_enc']);
$stmt = $pdo->prepare('SELECT t.*, us.username AS admin_username FROM tanggapan t JOIN users us
                        ON us.id = t.admin_id WHERE t.laporan_id = ? ORDER BY t.created_at ASC'
);
$stmt->execute([$id]);
$tanggapanList = $stmt->fetchAll();
$pageTitle = 'Kelola Laporan';
include __DIR__ . '/../includes/header.php';
?>

<?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>

<div class="card">
  <div class="detail-head">
    <h2><?= e($laporan['judul']) ?></h2>
    <span class="badge badge-<?= strtolower($laporan['status']) ?>"><?= e($laporan['status']) ?></span>
  </div>

  <?php if ($laporan['is_flagged']): ?>
    <div class="alert alert-warning">
      Laporan ini terindikasi mengandung kata kasar / pola spam. Periksa isi laporan sebelum ditindaklanjuti,
      atau hapus dari halaman Dashboard jika memang spam.
    </div>
  <?php endif; ?>

  <p><strong>Kategori:</strong> <?= e($laporan['kategori']) ?></p>
  <p><strong>Tanggal Lapor:</strong> <?= formatTanggal($laporan['created_at']) ?></p>
  <p><strong>Pelapor:</strong>
    <?php if ($laporan['is_anonim']): ?>
      <em>Identitas dirahasiakan (mode anonim) &mdash; dilindungi sistem demi keamanan pelapor.</em>
    <?php else: ?>
      <?= e($namaPelapor ?? '-') ?> &middot; NIK: <?= e($nikPelapor ?? '-') ?> &middot; Username: <?= e($laporan['username']) ?>
    <?php endif; ?>
  </p>

  <div class="content-box">
    <strong>Isi Laporan:</strong>
    <p><?= nl2br(e($isiDecrypted)) ?></p>
  </div>

  <form method="post" class="status-form">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="laporan_id" value="<?= (int)$id ?>">
    <input type="hidden" name="action" value="update_status">
    <label>Ubah Status:</label>
    <select name="status">
      <?php foreach (['Pending', 'Proses', 'Selesai'] as $s): ?>
        <option value="<?= $s ?>" <?= $laporan['status'] === $s ? 'selected' : '' ?>><?= $s ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-sm btn-primary">Perbarui Status</button>
  </form>
</div>

<div class="card">
  <h3>Tanggapan &amp; Tindak Lanjut</h3>

  <?php if (empty($tanggapanList)): ?>
    <p class="empty-state">Belum ada tanggapan. Tambahkan tanggapan pertama di bawah.</p>
  <?php endif; ?>

  <?php foreach ($tanggapanList as $t): ?>
    <div class="tanggapan-item">
      <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="laporan_id" value="<?= (int)$id ?>">
        <input type="hidden" name="tanggapan_id" value="<?= (int)$t['id'] ?>">
        <input type="hidden" name="action" value="edit_tanggapan">
        <p class="meta">Oleh: <?= e($t['admin_username']) ?> &middot; <?= formatTanggal($t['created_at']) ?></p>
        <textarea name="isi_tanggapan" rows="3"><?= e($t['isi_tanggapan']) ?></textarea>
        <div class="tanggapan-actions">
          <button type="submit" class="btn btn-sm">Simpan Perubahan</button>
        </div>
      </form>
      <form method="post" onsubmit="return confirm('Hapus tanggapan ini?');" class="inline-form">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <input type="hidden" name="laporan_id" value="<?= (int)$id ?>">
        <input type="hidden" name="tanggapan_id" value="<?= (int)$t['id'] ?>">
        <input type="hidden" name="action" value="delete_tanggapan">
        <button type="submit" class="btn btn-sm btn-danger">Hapus Tanggapan</button>
      </form>
    </div>
    <hr>
  <?php endforeach; ?>

  <h4>Tambah Tanggapan Baru</h4>
  <form method="post">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="laporan_id" value="<?= (int)$id ?>">
    <input type="hidden" name="action" value="add_tanggapan">
    <textarea name="isi_tanggapan" rows="4" placeholder="Tulis tanggapan / tindak lanjut untuk pelapor..." required></textarea>
    <button type="submit" class="btn btn-primary">Kirim Tanggapan</button>
  </form>
</div>

<a href="dashboard.php" class="btn">&laquo; Kembali ke Dashboard</a>
<?php include __DIR__ . '/../includes/footer.php'; ?>