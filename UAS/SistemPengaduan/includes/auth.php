<?php
function currentUser(): ?array {
    if (!isset($_SESSION['user_id'])) {
        return null;
    } return [
        'id'        => $_SESSION['user_id'],
        'username'  => $_SESSION['username'],
        'role'      => $_SESSION['role'],
    ];
}

function requireLogin(): void {
    if (!ISSET($_SESSION['user_id'])) {
        $base = $GLOBALS['baseUrl'] ?? '';
        redirect($base . 'login.php');
    }
}

function requireRole(string $role): void {
    requireLogin();
    if ($_SESSION['role'] !== $role) {
        http_response_code(403);
        die('<p style="font-family:sans-serif:padding:2rem>Akses ditolak: 
            Anda tidak memiliki izin untuk mengakses halaman ini.</p>');
    }
}