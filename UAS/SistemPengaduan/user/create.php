<?php
require_once __DIR__ . '/../includes/init.php';
$baseUrl = '../';
requireRole('user');
$u = currentUser();
$error = '';
$kategoriList = ['Pelayanan Publik', 'Infrastruktur', 'Korupsi/Pungli', 'Lingkungan', 'Kesehatan', 'Lainnya'];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $error = 'Token keamanan tidak valid.';
    } else {
        $judul = trim($_POST['judul'] ?? '');
        $kategori = trim($_POST['kategori'] ?? '');
        $isi = trim($_POST['isi_laporan'] ?? '');
        $isAnonim = isset($_POST['is_anonim']) ? 1 : 0;
        if ($judul === '' || $kategori === '' || $isi === '') {
            $error = 'Semua field wajib diisi.';
        } else {
            $flagged = (containsBadWords($judul) || containsBadWords($isi)) ? 1 : 0;
            $isiEnc = encryptData($isi);
            $stmt = $pdo->prepare('INSERT INTO laporan (user_id, judul, kategori, isi_laporan_enc, status, is_anonim, is_flagged)
                                    VALUES (?, ?, ?, ?, "Pending", ?, ?)'
            );
            $stmt->execute([$u['id'], $judul, $kategori, $isiEnc, $isAnonim, $flagged]);
            redirect('dashboard.php');
        }
    } 
}

$pageTitle = 'Buat Laporan';
include __DIR__ . '/../includes/header.php';
?>
<div class="card form-card">
  <h2>Buat Laporan / Aspirasi Baru</h2>
  <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label>Judul Aduan</label>
    <input type="text" name="judul" required value="<?= e($_POST['judul'] ?? '') ?>">
    <label>Kategori</label>
    <select name="kategori" required>
      <option value="">-- Pilih Kategori --</option>
      <?php foreach ($kategoriList as $k): ?>
        <option value="<?= e($k) ?>" <?= (($_POST['kategori'] ?? '') === $k) ? 'selected' : '' ?>><?= e($k) ?></option>
      <?php endforeach; ?>
    </select>
    <label>Isi Laporan</label>
    <textarea name="isi_laporan" rows="6" required><?= e($_POST['isi_laporan'] ?? '') ?></textarea>
    <label class="checkbox-label">
      <input type="checkbox" name="is_anonim" <?= isset($_POST['is_anonim']) ? 'checked' : '' ?>>
      Laporkan secara anonim (identitas saya disembunyikan dari petugas)
    </label>
    <p class="hint">Isi laporan Anda disimpan dalam bentuk terenkripsi (AES-256) di basis data.</p>
    <button type="submit" class="btn btn-primary">Kirim Laporan</button>
  </form>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>