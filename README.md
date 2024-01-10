# attendance

勤怠管理システム

概要：

##作成した目的

概要：人事評価のため勤怠管理システムを導入する

##アプリケーション URL
※未記載
　デプロイの URL、ログインなどがあれば注意事項

##他のリポジトリ
※未記載
関連するリポジトリがあれば記載

##機能一覧
※未記載

##使用技術（実行環境）
PHP:8.0

Laravel:8.6.12

MySQL:8.0

Composser:2.6.6

##テーブル設計
※設計書レビュー後に

##ER 図
※設計書レビュー後に

##環境構築

Docker ビルド

1.git の URL を記載する

2.docker-compose up -d --build

Laravel 環境構築

1.PHP コンテナ内にログイン
　 docker-compose exec php bash

2.ログイン後、必要なパッケージをインストール
　 composser install

3.「.env.example」ファイルをコピーして「.env」ファイルを作成
　 cp .env.example .env

4.「.env」ファイルの環境変数を変更
　 DB_HOST=mysql

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass

5.アプリケーション起動のためのキーを生成
　 php artisan key:generate

6.マイグレーションを実行
　 php artisan migrate

7.データベースへテスト用の初期データを投入
　 php artisan db:seed

##その他記述
