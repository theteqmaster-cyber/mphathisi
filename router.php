<?php
/**
 * Local Router for PHP Development Server
 * Mimics Vercel routing rules: maps assets/videos, /download to download.php, and others to index.php.
 */

$uri = decode_url_path(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static assets directly
if (preg_match('#^/assets/#', $uri) || preg_match('#^/videos/#', $uri)) {
    $filePath = __DIR__ . $uri;
    if (file_exists($filePath) && !is_dir($filePath)) {
        // Let PHP serve the file directly
        return false;
    }
}

// Route for /download -> api/download.php
if ($uri === '/download' || $uri === '/download.php') {
    require __DIR__ . '/api/download.php';
    exit;
}

// Fallback: route everything else to api/index.php
$_SERVER['SCRIPT_NAME'] = '/api/index.php';
require __DIR__ . '/api/index.php';

function decode_url_path($path) {
    return rawurldecode($path);
}
