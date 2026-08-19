---
name: static-build
description: Build this PHP corporate site into static HTML under dist/ with scripts/build.php, using the BASE_PATH prefix that the local environment requires, and preview the result through scripts/preview.php on a local PHP server. Use when asked to build, rebuild, preview, verify the static output, or reproduce the GitHub Pages build locally.
---

# 静的ビルド (corporate-site)

`scripts/build.php` が各 `index.php` をレンダリングして `dist/` に静的 HTML を出力する。
CI（`.github/workflows/pages.yml`）と同じ処理をローカルで実行するための手順。詳細な背景は `README.md` を参照。

## 前提の確認

```powershell
php -v
```

PHP 8.2 以上（CI は 8.2）。見つからない場合はユーザーに PHP のインストール／パス設定を依頼する。

## まとめて実行（推奨）

「ビルドして再起動」を求められたら、既存サーバーの停止・ビルド・起動を一度に行うこれを使う。

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File scripts/serve.ps1
```

- 既定は `BASE_PATH=/corporate-site`、ポート 8000。`-BasePath ''` でルート直下配信、`-Port` で変更。
- `-NoServe` を付けるとビルドのみ。
- サーバーは前面で動き続けるので、Bash ツールから使う場合はバックグラウンドで起動してから
  `curl` で確認する。ログの `Development Server (http://localhost:8000) started` が起動完了の合図。
- `.ps1` は UTF-8 BOM 付きで保存すること。BOM なしだと Windows PowerShell 5.1 が ANSI として読み、
  日本語メッセージが文字化けする。

以下は個別に実行する場合の手順。

## ビルド

**ローカル環境ではサブディレクトリ配下で配信するため、`BASE_PATH` 付きでビルドするのが既定**。
指定がなければ `/corporate-site` を使い、その値を使った旨をユーザーに伝える。
ルート相対の `href` / `src` / `action` と `common/css` 配下の `url(/...)` が書き換えられる。

PowerShell:

```powershell
$env:BASE_PATH = "/corporate-site"; php scripts/build.php
```

Bash ツール（Git Bash）から実行する場合は `MSYS_NO_PATHCONV=1` が必須。
付けないと `/corporate-site` が Windows パスに変換され、`Using BASE_PATH=/C:/Program Files/Git/...` になる。

```bash
MSYS_NO_PATHCONV=1 BASE_PATH=/corporate-site php scripts/build.php
```

- ログ 2 行目の `Using BASE_PATH=...` が意図した値か必ず確認する。この行が出ていなければプレフィックスなしのビルド。
- `dist/` は毎回削除して作り直される。ビルド前に確認は不要（`.gitignore` 済み）。
- 成功時の最終行は `Build complete.`。それ以外で終了した場合は失敗として扱う。
- 出力をパイプで `head` に渡さない。PHP が SIGPIPE で途中終了し、ビルドが不完全になる。
  長い出力を短くしたい場合はファイルへリダイレクトしてから `tail` する。

ルート直下配信の出力を作る場合のみ、環境変数なしで `php scripts/build.php`（= `npm run build`）を実行する。

## プレビュー

ビルドし直さずに既存の `dist/` を配信する場合は `-NoBuild` を使う:

```powershell
powershell -NoProfile -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoBuild
```

サーバーだけを直接起動する場合、ルーター `scripts/preview.php` の指定を省略しない
（省略すると `BASE_PATH` 付きビルドのリンクが全部 404 になる）:

```powershell
php -S localhost:8000 -t dist scripts/preview.php
```

- ルーターが `dist/index.html` からプレフィックスを自動判定するので、環境変数の再指定は不要。
  明示する場合は `BASE_PATH` を立てて起動すれば、そちらが優先される。
- `BASE_PATH=/corporate-site` のビルドは http://localhost:8000/corporate-site/ で見る。
  `/` は自動リダイレクトされる。
- プレフィックスなしのビルドでも同じコマンドで動く。

PHP ソースのまま（インクルード込みで編集を確認する。常にルート直下配信）:

```powershell
php -S localhost:8000
```

サーバーはバックグラウンドで起動し、確認が終わったら必ず停止する
（Windows では `netstat -ano` でポートの PID を調べて `taskkill //PID <pid> //F`）。

動作確認は HTTP ステータスで行うのが早い:

```bash
base=/corporate-site
for u in "$base/" "$base/recruit/" "$base/common/css/base.css"; do
  curl -s -o /dev/null -w "$u %{http_code}\n" "http://localhost:8000$u"
done
```

## 結果の確認ポイント

- ページ数: `dist/**/index.html` の数が、`dist/` 以外の `index.php` の数（PHPMailer 配下を除く）と一致するか。
- 新規ページを追加した場合、`Rendered <path>` のログに出ているか。
- `common/` と `favicon.ico` がコピーされているか。
- `BASE_PATH` 付きなら、`dist/index.html` のリンクが `href="/corporate-site/common/css/base.css"` の形になっているか。

## 注意

- `dist/` はコミットしない。
- `contact/` と `recruit/entry/` のフォームは `conf.php` への POST で、静的出力では動作しない。
  これは既知の制約であり、ビルドの不具合として報告しない。
- レンダリングで PHP エラーが起きるとビルド全体が失敗する。エラーメッセージに対象ファイルと stderr が含まれるので、
  そのページの `index.php` とインクルード先を確認する。
- 静的資材のパスは `/common/...` と書く。`/../common/...` は禁止。
  先頭の `/..` がブラウザ正規化時に `BASE_PATH` を打ち消し、サブディレクトリ配信で 404 になる
  （ルート直下配信では偶然動くため気付きにくい）。ページ追加時にこの書き方を見つけたら直す。
- `BASE_PATH` の書き換え対象は `href` / `src` / `action` / `srcset` / `imagesrcset` のみ。
  JS でのパス組み立てや `data-*` 属性の URL は書き換わらない。
