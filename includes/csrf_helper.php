<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Mengembalikan token CSRF untuk session saat ini.
 * Token dibuat sekali per session dan tidak pernah dikirim melalui URL.
 */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

/**
 * Memvalidasi token CSRF dari request menggunakan perbandingan konstan waktu.
 */
function csrf_token_valid(?string $token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && is_string($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Menghentikan request jika token CSRF tidak ada atau tidak valid.
 */
function require_valid_csrf_token(): void
{
    if (!csrf_token_valid($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        exit('Permintaan tidak valid. Token CSRF tidak cocok.');
    }
}
