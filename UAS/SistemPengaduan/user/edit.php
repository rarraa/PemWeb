<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('user');
$u = currentUser();
$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM laporan WHERE id = ? AND user_id = ?');
$stmt->execute([$id, $u['id']]);
$laporan = $stmt->fetch();
if (!$laporan) {
    die('<p style="font-family:sans-serif;padding:2rem">Laporan tidak ditemukan.</p>');
}
if ($laporan['status'] !== 'Pending') {
    die('<p style= "font_familt:sans-serif;padding:2rem">Laporan ini sudah diproses oleh petugas dan tidak dapat siubah lagi. <a href="dashboard.php">Kembali</a></p>');
}
$kategoriList = ['Pelayanan Publik', 'Infrastruktur', 'Korupsi/Pungli', 'lingkungan', 'Pendidikan', 'Kesehatan', 'Lainnya'];
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $error = 'Token keamanan tidak valid,';
    } else {
        $judul      = trim($_POST['judul'] ?? '');
        $kategori   = trim($_POST['kategori'] ?? '');
        $isi        = trim($_POST['isi_laporan'] ?? '');
        $isAnonim   = trim($_POST['is_anonim']) ? 1 : 0;
        if ($judul === '' || $kategori === '' || $isi === '') {
            $error = 'Semua field wajid diisi.';
        } else {
            $flagged = (containsBadWords($judul) || containsBadWords($isi)) ? 1 : 0;
            $isiEnc  = encryptData($isi);
            $upd = $pdo->prepare('UPDATE laporan SET judul=?, kategori=?, isi_laporan_enc=?, is_anonim=?, is_flagged=?
                                  WHERE id=? AND user_id=? AND status="Pending"'
            );
            $upd->execute([$judul, $kategori, $isiEnc, $isAnonim, $flagged, $id, $u['id']]);
            redirect('dashboard.php');
        }
    }
}
$isiDecrypted = decryptData($laporan['isi_laporan_enc']);
$pageTitle = 'Edit Laporan';
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card">
  <h2>Edit Laporan</h2>
  <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <input type="hidden" name="id" value="<?= (int)$laporan['id'] ?>">
    <label>Judul Aduan</label>
    <input type="text" name="judul" required value="<?= e($_POST['judul'] ?? $laporan['judul']) ?>">
    <label>Kategori</label>
    <select name="kategori" required>
      <?php foreach ($kategoriList as $k): ?>
        <option value="<?= e($k) ?>" <?= (($_POST['kategori'] ?? $laporan['kategori']) === $k) ? 'selected' : '' ?>><?= e($k) ?></option>
      <?php endforeach; ?>
    </select>
    <label>Isi Laporan</label>
    <textarea name="isi_laporan" rows="6" required><?= e($_POST['isi_laporan'] ?? $isiDecrypted) ?></textarea>
    <label class="checkbox-label">
      <input type="checkbox" name="is_anonim" <?= ($laporan['is_anonim'] ? 'checked' : '') ?>>
      Laporkan secara anonim
    </label>
    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    <a href="dashboard.php" class="btn">Batal</a>
  </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>