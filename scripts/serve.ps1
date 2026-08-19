<#
.SYNOPSIS
    静的ビルドとプレビューサーバーの起動をまとめて実行する。

.DESCRIPTION
    既存のプレビューサーバーを停止し、BASE_PATH 付きでビルドし直してから
    scripts/preview.php をルーターとする PHP 内蔵サーバーを起動する。

.EXAMPLE
    powershell -ExecutionPolicy Bypass -File scripts/serve.ps1
    ローカル既定の /corporate-site 配下で起動する。

.EXAMPLE
    powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -BasePath '' -Port 8080
    本番と同じルート直下配信の出力を 8080 番で確認する。

.EXAMPLE
    powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoServe
    ビルドだけ実行してサーバーは起動しない。

.EXAMPLE
    powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoBuild
    ビルド済みの dist/ をそのまま配信する。
#>
[CmdletBinding()]
param(
    [string]$BasePath = '/corporate-site',
    [int]$Port = 8000,
    [switch]$NoServe,
    [switch]$NoBuild
)

$ErrorActionPreference = 'Stop'

# Windows PowerShell 5.1 は既定でコンソールの ANSI コードページに出力するため、
# 日本語が化けないよう UTF-8 を明示する。
try {
    [Console]::OutputEncoding = [System.Text.Encoding]::UTF8
} catch {
    # リダイレクト先によっては設定できないが、処理は続行する
}

Set-Location (Split-Path -Parent $PSScriptRoot)

function Stop-PortListener {
    param([int]$Port)

    try {
        $listeners = Get-NetTCPConnection -LocalPort $Port -State Listen -ErrorAction Stop |
            Select-Object -ExpandProperty OwningProcess -Unique
    } catch {
        $listeners = netstat -ano |
            Select-String ":$Port\s+.*LISTENING" |
            ForEach-Object { ($_ -split '\s+')[-1] } |
            Sort-Object -Unique
    }

    foreach ($listener in $listeners) {
        if ($listener -and $listener -ne 0) {
            Write-Host "既存サーバーを停止: PID $listener"
            Stop-Process -Id $listener -Force -ErrorAction SilentlyContinue
        }
    }
}

if ([string]::IsNullOrWhiteSpace($BasePath) -or $BasePath -eq '/') {
    $normalized = ''
} else {
    $normalized = '/' + $BasePath.Trim('/')
}

Stop-PortListener -Port $Port

if ($NoBuild) {
    if (-not (Test-Path 'dist')) {
        throw 'dist/ がありません。-NoBuild を外して実行してください。'
    }
    # 配信するのは既存のビルド結果なので、プレフィックスは preview.php に
    # dist/index.html から判定させる。
    $env:BASE_PATH = ''
} else {
    $env:BASE_PATH = $normalized
    if ($normalized -eq '') {
        Write-Host 'ビルド中... (BASE_PATH なし / ルート直下配信)'
    } else {
        Write-Host "ビルド中... (BASE_PATH=$normalized)"
    }

    php scripts/build.php
    if ($LASTEXITCODE -ne 0) {
        throw "ビルドに失敗しました (exit $LASTEXITCODE)"
    }
}

if ($NoServe) {
    return
}

Write-Host ''
if ($NoBuild) {
    Write-Host "プレビュー: http://localhost:$Port/ (ビルド結果のプレフィックスへ自動リダイレクト)"
} else {
    Write-Host "プレビュー: http://localhost:$Port$normalized/"
}
Write-Host '停止するには Ctrl+C'
Write-Host ''

php -S "localhost:$Port" -t dist scripts/preview.php
