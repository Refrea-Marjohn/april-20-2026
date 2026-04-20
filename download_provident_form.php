<?php
/**
 * Serve Provident Fund Application Form from downloads folder for direct download.
 * Place your PDF in: downloads/ (e.g. Provident Fund Application.pdf)
 */
$dir = __DIR__ . '/downloads';
$files = glob($dir . '/*.pdf');
if (empty($files) || !is_file($files[0])) {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: text/plain; charset=utf-8');
    echo 'Form file not found.';
    exit;
}
$path = $files[0];
$name = basename($path);
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . preg_replace('/[^\w\.\-]/', '_', $name) . '"');
header('Content-Length: ' . filesize($path));
header('Cache-Control: no-cache, must-revalidate');
readfile($path);
exit;
