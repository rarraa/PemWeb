<?php
define('ENC_SECRET', 'KucingOranyeMakanMieAyam#2026!DiAtasGenting');
define('ENC_METHOD', 'aes-256-cbc');
function getEncKey(): string
{return hash('sha256', ENC_SECRET, true);}
function encryptData(?string $plaintext): ?string {
    if ($plaintext === null || $plaintext === '') {
        return null;
    }
    $key = getEncKey();
    $ivLen = openssl_cipher_iv_length(ENC_METHOD);
    $iv = openssl_random_pseudo_bytes($ivLen);
    $cipherRaw = openssl_encrypt($plaintext, ENC_METHOD, $key, OPENSSL_RAW_DATA, $iv);
    if ($cipherRaw === false) {
        return null;
    }
    return base64_encode($iv) . '::' . base64_encode($cipherRaw);
}
function decryptData(?string $encoded): ?string {
    if ($encoded === null || $encoded === '') {
        return null;
    }
    $parts = explode('::', $encoded, 2);
    if (count($parts) !== 2) {
        return null;
    }
    [$ivB64, $cipherB64] = $parts;
    $iv = base64_decode($ivB64);
    $cipherRaw = base64_decode($cipherB64);
    if ($iv === false || $cipherRaw === false) {
        return null;
    }
    $key = getEncKey();
    $plain = openssl_decrypt($cipherRaw, ENC_METHOD, $key, OPENSSL_RAW_DATA, $iv);
    return $plain === false ? null : $plain;
}
?>