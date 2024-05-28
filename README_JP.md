[EN](README.md) | [JP](README_JP.md)

# PHP ユーザー登録/ログインシステム (作業中)

これは、PHPとMySQLを使用したシンプルなユーザー登録/ログインシステムです。主に練習プロジェクトとしています。

## 考慮事項

- MySQLサーバーがインストールされていることを確認してください。バックエンドは起動時に接続を試みます。
- `composer`がインストールされていることを確認してください。
- 以下のように自分のDB変数を含むシンプルな.envファイルを作成してください：

```
DB_HOST=localhost
DB_NAME=usersys
DB_TABLE=users
DB_USER=root
DB_PASS=dbpwdhere # (もしあれば)
```

## 機能

- メールアドレスとパスワードでのユーザー登録
- メールアドレスとパスワードでのユーザーログイン
- 安全なストレージのためのパスワードハッシュ化
- MySQLデータベースの統合

## インストール

1. リポジトリをクローンします：`git clone https://github.com/YozoraWolf/wolf-vitephp-user-system`
2. `composer install`を実行します
3. `npm run dev`を実行します

## 使い方

1. ウェブブラウザを開き、`http://localhost:3005/pages/`に移動します
2. 新しいユーザーアカウントを登録します
3. あなたの資格情報でログインします

## ライセンス

このプロジェクトは[MITライセンス](LICENSE)の下でライセンスされています。