<?php
require_once __DIR__ . '/includes/init.php';
$baseurl = '';
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $error = 'Token keamanan tidak valid, silahkan coba lagi.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        $nama = trim($_POST['nama']?? '');
        $nik = trim($_POST['nik'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if ($username === '' || $password === '' || $nama === '' || $nik === '') {
            $error = 'semua field wajib diisi.';
        } elseif ($password !== $confirm) {
            $error = 'Konfigurasi password tidak cocok.';
        } elseif (!preg_match('/^\d{16}$/', $nik)) {
            $error = 'NIK harus terdiri dari 16 digit angka.';
        } elseif (strlen($password) <6) {
            $error = 'Password minimal 6 karakter.';
        } else {
            $check = $pdo->prepare('SELECT id FROM users WHERE username = ?');
            $check->execute([$username]);
            if ($check->fetch()) {
                $error = 'Username sudah digunakan, silahkan pilih username lain.';
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $namaEnc = encryptData($nama);
                $nikEnc = encryptData($nik);
                $stmt = $pdo->prepare('INSERT INTO users (username, password, role, nama_enc, nik_enc, email)
                     VALUES (?, ?, "user", ?, ?, ?)');
                $stmt->execute([$username, $hash, $namaEnc, $nikEnc, $email]);
                $success = 'Pendaftaran berhasil.';
            }
        }
    }
}

$pageTitle = 'Daftar';
include __DIR__ . '/includes/header.php';
?>
<div class="card form-card">
  <h2>Daftar Akun Masyarakat</h2>
  <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
  <?php if ($success): ?>
    <div class="alert alert-success"><?= e($success) ?> <a href="login.php">Masuk sekarang &raquo;</a></div>
  <?php else: ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label>Nama Lengkap</label>
    <input type="text" name="nama" required value="<?= e($_POST['nama'] ?? '') ?>">
    <label>NIK (16 digit)</label>
    <input type="text" name="nik" pattern="\d{16}" maxlength="16" required value="<?= e($_POST['nik'] ?? '') ?>">
    <label>Email (opsional)</label>
    <input type="email" name="email" value="<?= e($_POST['email'] ?? '') ?>">
    <label>Username</label>
    <input type="text" name="username" required value="<?= e($_POST['username'] ?? '') ?>">
    <label>Password</label>
    <input type="password" name="password" required>
    <label>Konfirmasi Password</label>
    <input type="password" name="confirm_password" required>
    <p class="hint">Nama dan NIK Anda disimpan dalam bentuk terenkripsi (AES-256) di basis data demi melindungi privasi Anda sebagai pelapor.</p>
    <button type="submit" class="btn btn-primary">Daftar</button>
  </form>
  <?php endif; ?>
  <p style="margin-top:1rem;font-size:0.9rem">Sudah punya akun? <a href="login.php">Masuk</a></p>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>