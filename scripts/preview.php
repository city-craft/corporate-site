<?php

declare(strict_types=1);

/**
 * Router for previewing the static build:
 *   php -S localhost:8000 -t dist scripts/preview.php
 *
 * Serves dist/ while stripping the BASE_PATH prefix, so a build made with
 * BASE_PATH=/corporate-site can be checked at http://localhost:8000/corporate-site/.
 * When BASE_PATH is not set, the prefix is detected from dist/index.html.
 */

$dist = realpath(__DIR__ . '/../dist');
if ($dist === false) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "dist/ not found. Run `php scripts/build.php` first.\n";
    return true;
}

$basePath = resolveBasePath($dist);
$uri = (string) parse_url((string) $_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rawurldecode($uri);

if ($basePath !== '') {
    if ($uri === '' || $uri === '/' || $uri === $basePath) {
        header('Location: ' . $basePath . '/', true, 302);
        return true;
    }

    if (strpos($uri, $basePath . '/') !== 0) {
        return notFound($uri, $basePath);
    }

    $uri = substr($uri, strlen($basePath));
}

$path = $dist . str_replace('\\', '/', $uri);
if (is_dir($path)) {
    if (substr($uri, -1) !== '/') {
        header('Location: ' . $basePath . $uri . '/', true, 302);
        return true;
    }
    $path .= 'index.html';
}

$real = realpath($path);
if ($real === false || !is_file($real) || !isInside($dist, $real)) {
    return notFound($uri, $basePath);
}

header('Content-Type: ' . contentType($real));
header('Content-Length: ' . (string) filesize($real));
header('Cache-Control: no-store');
readfile($real);

return true;

function resolveBasePath(string $dist): string
{
    $fromEnv = normalizeBasePath((string) getenv('BASE_PATH'));
    if ($fromEnv !== '') {
        return $fromEnv;
    }

    return detectBasePath($dist);
}

function detectBasePath(string $dist): string
{
    $indexHtml = $dist . '/index.html';
    if (!is_file($indexHtml)) {
        return '';
    }

    $html = (string) file_get_contents($indexHtml);
    if (preg_match('#\b(?:href|src)="(/[^"]*?)/common/#', $html, $matches) !== 1) {
        return '';
    }

    return normalizeBasePath($matches[1]);
}

function normalizeBasePath(string $basePath): string
{
    $basePath = trim($basePath);
    if ($basePath === '' || $basePath === '/') {
        return '';
    }

    return '/' . trim($basePath, '/');
}

function isInside(string $dist, string $path): bool
{
    $dist = rtrim(str_replace('\\', '/', $dist), '/');
    $path = str_replace('\\', '/', $path);

    return strpos($path, $dist . '/') === 0;
}

function contentType(string $path): string
{
    $types = [
        'html' => 'text/html; charset=UTF-8',
        'css' => 'text/css; charset=UTF-8',
        'js' => 'text/javascript; charset=UTF-8',
        'json' => 'application/json; charset=UTF-8',
        'xml' => 'application/xml; charset=UTF-8',
        'txt' => 'text/plain; charset=UTF-8',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'eot' => 'application/vnd.ms-fontobject',
        'mp4' => 'video/mp4',
        'webm' => 'video/webm',
        'pdf' => 'application/pdf',
    ];

    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    return $types[$extension] ?? 'application/octet-stream';
}

function notFound(string $uri, string $basePath): bool
{
    http_response_code(404);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "404 Not Found: {$uri}\n";

    if ($basePath !== '') {
        echo "BASE_PATH={$basePath} でプレビュー中です。 http://{$_SERVER['HTTP_HOST']}{$basePath}/ を開いてください。\n";
    }

    return true;
}
