# corporate-site

PHP のインクルード（`header.php` / `footer.php` など）で構成されたコーポレートサイトです。
`scripts/build.php` で各 `index.php` をレンダリングし、静的 HTML として `dist/` に出力します。

GitHub Actions（`.github/workflows/pages.yml`）では PHP 8.2 上で `php scripts/build.php` を実行し、
`dist` を成果物としてアップロード、`main` ブランチのみ GitHub Pages へデプロイしています。
以下はそれと同じビルドをローカルで再現する手順です。

## 0. クイックスタート

ビルドとプレビューサーバーの起動をまとめて実行します。既にサーバーが起動していれば自動で停止するため、
**そのまま「再起動」用のコマンドとしても使えます。**

```powershell
npm run serve
```

```powershell
# npm を使わない場合
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1
```

→ http://localhost:8000/corporate-site/

停止は `Ctrl+C` です。以降は各手順の詳細を説明します。

## 1. 前提条件

- PHP CLI 8.2 以上（CI は 8.2、ローカルは 8.3 で動作確認済み）
- Node.js（任意。`npm run build` を使う場合のみ）

インストール確認:

```powershell
php -v
```

パスが通っていない場合は PHP の実行ファイルを直接指定するか、`Path` 環境変数に追加してください。

## 2. ビルド（BASE_PATH 付き）

ローカル環境ではサイトをサブディレクトリ配下（例: `/corporate-site`）で配信するため、
`BASE_PATH` を指定してビルドします。ルート相対リンク（`href` / `src` / `action`）と
CSS 内の `url(/...)` に、そのプレフィックスが付与されます。

PowerShell:

```powershell
$env:BASE_PATH = "/corporate-site"; php scripts/build.php
```

Git Bash / WSL / Linux:

```bash
MSYS_NO_PATHCONV=1 BASE_PATH=/corporate-site php scripts/build.php
```

> Git Bash では `MSYS_NO_PATHCONV=1` を付けないと `/corporate-site` が Windows パスへ変換され、
> `Using BASE_PATH=/C:/Program Files/Git/corporate-site` のように壊れます。

ログの 2 行目に `Using BASE_PATH=/corporate-site` と出ることを必ず確認してください。
`dist/` は毎回削除されてから作り直されます。成功すると以下のように出力されます。

```
Building static site into dist...
Using BASE_PATH=/corporate-site
Rendered access/index.php                         -> dist/access/index.html
...
Build complete.
```

プレフィックスは配信先に合わせて変更してください。値の前後のスラッシュは自動で正規化されます。

### BASE_PATH なしのビルド

```powershell
php scripts/build.php
```

npm スクリプト（`npm run build`）も同じくプレフィックスなしのビルドです。
ルート直下（`https://example.com/`）配信用の出力になります。

`BASE_PATH` の有無を切り替えたら、必ずビルドし直してください。既存の `dist/` は書き換えられません。

## 3. プレビュー

### ビルド結果（dist）を確認する

ビルドし直さずに、既存の `dist/` をそのまま配信します。

```powershell
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoBuild
```

```powershell
# npm / VS Code を使わず直接起動する場合
php -S localhost:8000 -t dist scripts/preview.php
```

`scripts/preview.php` は `BASE_PATH` のプレフィックスを取り除いて `dist/` を配信するルーターです。
これを付けずに `php -S localhost:8000 -t dist` だけで起動すると、
`BASE_PATH` 付きビルドのリンクはすべて 404 になります。

- `BASE_PATH=/corporate-site` でビルドした場合 → http://localhost:8000/corporate-site/
- `/` を開くと `BASE_PATH` 側へ自動リダイレクトされます
- プレフィックスは `dist/index.html` から自動判定されます。明示したい場合は起動時に
  `$env:BASE_PATH = "/corporate-site"` を設定してください（環境変数が優先されます）
- `BASE_PATH` なしのビルドでもそのまま使えます → http://localhost:8000/

### ビルドと再起動をまとめて実行する

`scripts/serve.ps1` が「既存サーバーの停止 → ビルド → サーバー起動」を順に実行します。

```powershell
npm run serve
```

オプションで配信先と待ち受けポートを変更できます。

```powershell
# 本番と同じルート直下配信の出力を確認する
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -BasePath ''

# ポートを変える
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -Port 8080

# ビルドだけ実行してサーバーは起動しない
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoServe

# ビルドせず、既存の dist/ をそのまま配信する
powershell -ExecutionPolicy Bypass -File scripts/serve.ps1 -NoBuild
```

ビルド・プレビュー・再起動はすべてこのスクリプトに集約しています。`npm run serve` も
VS Code のタスクも、引数違いでこれを呼んでいるだけです。

### VS Code から実行する

`.vscode/tasks.json` と `.vscode/launch.json` を用意しています。

| 操作 | 内容 |
| --- | --- |
| `F5`（デバッグの開始） | ビルドしてサーバーを起動し、ブラウザで開く（Edge / Chrome を選択） |
| `Ctrl+Shift+B`（ビルドタスク実行） | `build` タスク（ビルドのみ） |
| `Ctrl+Shift+P` → `Tasks: Run Task` | `build` / `serve` を選択 |

どちらも `BASE_PATH=/corporate-site` 前提で、開く URL は http://localhost:8000/corporate-site/ です。
ルート直下配信の確認は VS Code の構成を増やさず、`scripts/serve.ps1 -BasePath ''` を使ってください。

サーバーはタスクとしてターミナルパネルに残るので、停止するときはそのターミナルで `Ctrl+C` するか、
ゴミ箱アイコンでタスクを終了してください。

### PHP ソースのまま確認する（編集時）

```powershell
php -S localhost:8000
```

`npm run dev` も同じです。ルートを指定せずに起動すると `index.php` がそのまま実行されるため、
インクルードを含めた編集内容をビルドせずに確認できます。
こちらは常にルート直下（`BASE_PATH` なし）での配信になります。

サーバーは `Ctrl+C` で停止します。

## 4. ビルドの内容

`scripts/build.php` が行う処理:

| 処理 | 内容 |
| --- | --- |
| クリーン | `dist/` を削除して再作成 |
| 静的資材のコピー | `common/`、`favicon.ico`、`CNAME`（存在する場合） |
| HTML のコピー | `dist/` 以外のすべての `.html` をパス構造を保ったままコピー |
| ページのレンダリング | 各 `index.php` を別プロセスの PHP で実行し `dist/<パス>/index.html` として保存 |
| リンク書き換え | `BASE_PATH` 指定時のみ、HTML の `href` / `src` / `action` / `srcset` / `imagesrcset` と `common/css` 配下の `url(/...)` を書き換え |

レンダリング時は `REQUEST_URI` にそのページの URL（ルートは `/`）を設定して実行します。
`PHPMailer` ディレクトリ配下の `index.php` はレンダリング対象から除外されます。

`scripts/preview.php` はビルドには関与しません。プレビュー用サーバーのルーターとしてのみ使います。

## 5. 注意点

- `dist/` は `.gitignore` 済みです。コミットせず、ビルドで再生成してください。
- お問い合わせ（`contact/`）とエントリー（`recruit/entry/`）のフォームは `conf.php` へ POST する PHP 処理です。
  静的ビルドには含まれないため、`dist/` 上ではフォーム送信は動作しません。動作確認は PHP サーバー上で行ってください。
- ページを追加するときは `<新ディレクトリ>/index.php` を作成すれば、ビルド時に自動で検出されます。
- **静的資材のパスは `/common/...` と書いてください。`/../common/...` や `/../../common/...` と書いてはいけません。**
  先頭の `/..` はブラウザが正規化する際に `BASE_PATH` のプレフィックスごと打ち消してしまい、
  サブディレクトリ配信で 404 になります。ルート直下配信では偶然動くため気付きにくい不具合です。
- `BASE_PATH` の書き換え対象は上記の属性のみです。JS からパスを組み立てる場合や
  `data-*` 属性に URL を持たせる場合は、書き換えが効かない点に注意してください。
- レンダリング中に PHP エラーが発生したページがあるとビルド全体が失敗し、該当ファイルと標準エラー出力が表示されます。
- CI（`.github/workflows/pages.yml`）は `BASE_PATH` を設定していません。GitHub Pages 側の公開 URL が
  `https://city-craft.github.io/corporate-site/` のようなサブパスであれば、CI 側にも
  `env: BASE_PATH: /corporate-site` の指定が必要です（カスタムドメインでルート配信している場合は不要）。

## 6. Claude Code から実行する

`/static-build` スキル（`.claude/skills/static-build/SKILL.md`）を用意しています。
ビルド、`BASE_PATH` 付きビルド、プレビュー起動までを同じ手順で実行できます。
