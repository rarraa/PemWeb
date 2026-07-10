<?php
require_once __DIR__ . '/includes/init.php';
$baseUrl = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? null)) {
        $error = 'Token keamanan tidak valid, silahkan coba lagi.';
        } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            redirect($user['role'] === 'admin' ? 'admin/dashboard.php' : 'user/dashboard.php');
        } else {
            $error = 'Username atau password salah.';
        }
    }
}

$pageTitle = 'Masuk';
include __DIR__ . '/includes/header.php';
?>
<div class="card form-card">
  <h2>Masuk ke SIPMA</h2>
  <?php if ($error): ?><div class="alert alert-error"><?= e($error) ?></div><?php endif; ?>
  <form method="post" novalidate>
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
    <label>Username</label>
    <input type="text" name="username" required autofocus>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit" class="btn btn-primary">Masuk</button>
  </form>
  <p style="margin-top:1rem;font-size:0.9rem">Belum punya akun? <a href="register.php">Daftar sebagai masyarakat</a></p>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>