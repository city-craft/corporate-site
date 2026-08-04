<?php

declare(strict_types=1);

$root = realpath(__DIR__ . '/..');
if ($root === false) {
    fwrite(STDERR, "Failed to resolve project root.\n");
    exit(1);
}

$dist = $root . '/dist';
$basePath = normalizeBasePath((string) getenv('BASE_PATH'));

removeDirectory($dist);
mkdir($dist, 0777, true);

echo "Building static site into dist...\n";
if ($basePath !== '') {
    echo "Using BASE_PATH={$basePath}\n";
}

copyIfExists($root . '/common', $dist . '/common');
copyIfExists($root . '/favicon.ico', $dist . '/favicon.ico');
copyIfExists($root . '/CNAME', $dist . '/CNAME');

copyHtmlFiles($root, $dist);

$pages = discoverRenderablePages($root);
sort($pages);

foreach ($pages as $sourcePath) {
    $requestUri = sourcePathToRequestUri($sourcePath);
    $html = renderPhpPage($root, $sourcePath, $requestUri);

    if ($basePath !== '') {
        $html = rewriteRootLinks($html, $basePath);
    }

    $outputPath = sourcePathToOutputPath($dist, $sourcePath);
    ensureParentDirectory($outputPath);
    file_put_contents($outputPath, $html);

    echo sprintf("Rendered %-40s -> %s\n", $sourcePath, relativePath($root, $outputPath));
}

if ($basePath !== '') {
    rewriteCssRootUrls($dist, $basePath);
}

echo "Build complete.\n";

function discoverRenderablePages(string $root): array
{
    $pages = [];
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $fileInfo) {
        if (!$fileInfo->isFile() || $fileInfo->getFilename() !== 'index.php') {
            continue;
        }

        $fullPath = $fileInfo->getPathname();
        if (strpos(toUnixPath(relativePath($root, $fullPath)), '/PHPMailer/') !== false) {
            continue;
        }

        if (strpos(toUnixPath(relativePath($root, $fullPath)), '/dist/') === 0) {
            continue;
        }

        $pages[] = toUnixPath(relativePath($root, $fullPath));
    }

    return $pages;
}

function sourcePathToRequestUri(string $sourcePath): string
{
    if ($sourcePath === 'index.php') {
        return '/';
    }

    $dir = dirname($sourcePath);
    if ($dir === '.') {
        return '/';
    }

    return '/' . toUnixPath($dir);
}

function sourcePathToOutputPath(string $dist, string $sourcePath): string
{
    if ($sourcePath === 'index.php') {
        return $dist . '/index.html';
    }

    $dir = dirname($sourcePath);
    return $dist . '/' . toUnixPath($dir) . '/index.html';
}

function renderPhpPage(string $root, string $relativeSourcePath, string $requestUri): string
{
    $sourceFullPath = $root . '/' . $relativeSourcePath;
    $runnerFile = tempnam(sys_get_temp_dir(), 'render-');
    if ($runnerFile === false) {
        throw new RuntimeException('Failed to create temporary runner file.');
    }

    $runnerPhp = $runnerFile . '.php';
    rename($runnerFile, $runnerPhp);

    $runnerCode = "<?php\n"
        . "error_reporting(E_ALL);\n"
        . '$_SERVER["REQUEST_URI"] = ' . var_export($requestUri, true) . ";\n"
        . '$_SERVER["SERVER_NAME"] = ' . var_export('localhost', true) . ";\n"
        . '$_SERVER["HTTP_HOST"] = ' . var_export('localhost', true) . ";\n"
        . '$_SERVER["DOCUMENT_ROOT"] = ' . var_export($root, true) . ";\n"
        . "chdir(" . var_export($root, true) . ");\n"
        . "ob_start();\n"
        . "include " . var_export($sourceFullPath, true) . ";\n"
        . "echo ob_get_clean();\n";

    file_put_contents($runnerPhp, $runnerCode);

    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($runnerPhp);
    $descriptorSpec = [
        0 => ['pipe', 'r'],
        1 => ['pipe', 'w'],
        2 => ['pipe', 'w'],
    ];

    $process = proc_open($cmd, $descriptorSpec, $pipes, $root);
    if (!is_resource($process)) {
        @unlink($runnerPhp);
        throw new RuntimeException('Failed to start PHP render process.');
    }

    fclose($pipes[0]);
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);

    $exitCode = proc_close($process);
    @unlink($runnerPhp);

    if ($exitCode !== 0) {
        throw new RuntimeException(
            "Failed to render {$relativeSourcePath} (URI: {$requestUri}).\n{$stderr}"
        );
    }

    return (string) $stdout;
}

function copyHtmlFiles(string $root, string $dist): void
{
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $fileInfo) {
        if (!$fileInfo->isFile()) {
            continue;
        }

        if (strtolower($fileInfo->getExtension()) !== 'html') {
            continue;
        }

        $relative = toUnixPath(relativePath($root, $fileInfo->getPathname()));
        if (strpos($relative, 'dist/') === 0) {
            continue;
        }

        $target = $dist . '/' . $relative;
        ensureParentDirectory($target);
        copy($fileInfo->getPathname(), $target);
    }
}

function copyIfExists(string $source, string $target): void
{
    if (!file_exists($source)) {
        return;
    }

    if (is_dir($source)) {
        copyDirectory($source, $target);
        return;
    }

    ensureParentDirectory($target);
    copy($source, $target);
}

function copyDirectory(string $source, string $target): void
{
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $itemPath = $item->getPathname();
        $relative = relativePath($source, $itemPath);
        $destPath = $target . '/' . toUnixPath($relative);

        if ($item->isDir()) {
            if (!is_dir($destPath)) {
                mkdir($destPath, 0777, true);
            }
        } else {
            ensureParentDirectory($destPath);
            copy($itemPath, $destPath);
        }
    }
}

function removeDirectory(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );

    foreach ($iterator as $item) {
        if ($item->isDir()) {
            rmdir($item->getPathname());
        } else {
            unlink($item->getPathname());
        }
    }

    rmdir($dir);
}

function ensureParentDirectory(string $path): void
{
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

function relativePath(string $base, string $path): string
{
    $base = rtrim(str_replace('\\', '/', $base), '/');
    $path = str_replace('\\', '/', $path);

    if (strpos($path, $base . '/') === 0) {
        return substr($path, strlen($base) + 1);
    }

    return $path;
}

function toUnixPath(string $path): string
{
    return str_replace('\\', '/', $path);
}

function normalizeBasePath(string $basePath): string
{
    $basePath = trim($basePath);
    if ($basePath === '' || $basePath === '/') {
        return '';
    }

    $basePath = '/' . trim($basePath, '/');
    return $basePath;
}

function rewriteRootLinks(string $html, string $basePath): string
{
    return preg_replace_callback(
        '/\b(href|src|action)=(["\'])\/(?!\/)([^"\']*)\2/',
        static function (array $matches) use ($basePath): string {
            $attr = $matches[1];
            $quote = $matches[2];
            $path = normalizeRootRelativePath($matches[3]);
            return sprintf('%s=%s%s/%s%s', $attr, $quote, $basePath, $path, $quote);
        },
        $html
    ) ?? $html;
}

function normalizeRootRelativePath(string $path): string
{
    // Prevent "/../foo" style paths from escaping BASE_PATH on project pages.
    $path = preg_replace('#^(?:\./|\.\./)+#', '', $path) ?? $path;
    return ltrim($path, '/');
}

function rewriteCssRootUrls(string $dist, string $basePath): void
{
    $cssRoot = $dist . '/common/css';
    if (!is_dir($cssRoot)) {
        return;
    }

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($cssRoot, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $fileInfo) {
        if (!$fileInfo->isFile() || strtolower($fileInfo->getExtension()) !== 'css') {
            continue;
        }

        $content = file_get_contents($fileInfo->getPathname());
        if ($content === false) {
            continue;
        }

        $updated = preg_replace('/url\(\/(?!\/)/', 'url(' . $basePath . '/', $content);
        if ($updated !== null && $updated !== $content) {
            file_put_contents($fileInfo->getPathname(), $updated);
        }
    }
}
