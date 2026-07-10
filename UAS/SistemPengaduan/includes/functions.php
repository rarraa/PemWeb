<?php
function e(?string $str): string {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
function redirect(string $url): void {
    header('Location: ' . $url);
    exit;
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } return $_SESSION['csrf_token'];
}

function verify_csrf(?string $token): bool {
    return isset($_SESSION['csrf_token']) && $token !== null
        && hash_equals($_SESSION['csrf_token'], $token);
}

function containsBadWords(string $text): bool {
    $badwords = [
        'tolol', 'sialan', 'brengsel', 'idiot',
    ];
    $textLower = strtolower($text);
    foreach ($badwords as $w) {
        if (str_contains($textLower, $w)) {
            return true;
        }
    }
    if (preg_match('/(.)\1{6,}/u', $textLower)) {
        return true;
    } return false;
}

function formatTanggal(string $datetime): string {
    $ts = strtotime($datetime);
    return $ts ? date('d-m-Y H:i', $ts) : $datetime;
}
?>