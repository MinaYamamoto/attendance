# attendance

勤怠管理システム

概要説明：社員の出勤、退勤、休憩時間の記録を行う。

![Alt text](image-2.png)

##作成した目的

概要：人事評価のため勤怠管理システムを導入する

##アプリケーション URL
本番環境は、AWS を使用
パブリック IP アドレス：http://54.248.86.202/

コンソールサインイン：https://058264478200.signin.aws.amazon.com/console

ユーザー名：testuser

コンソールパスワード：testuser1&

##他のリポジトリ

CodeCommit：ssh://git-codecommit.ap-northeast-1.amazonaws.com/v1/repos/attendance

※ミラーリング設定済

##機能一覧
※未記載

##使用技術（実行環境）
PHP:8.2.12

Laravel:8.6.12

MySQL:8.0.26

docker-compose:2.23.0

##テーブル設計
![Alt text](image.png)

##ER 図
![Alt text](image-1.png)

##環境構築

Docker ビルド

1.git clone git@github.com:MinaYamamoto/attendance.git

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

MAIL_MAILER=smtp

MAIL_HOST=mailcatcher

MAIL_FROM_ADDRESS=mailcatcher@example.com

5.「docker-compose.yml」ファイルに設定追加

mailcatcher:

image: schickling/mailcatcher

ports: - "1080:1080"

6.アプリケーション起動のためのキーを生成
　 php artisan key:generate

7.マイグレーションを実行
　 php artisan migrate

8.データベースへテスト用の初期データを投入
　 php artisan db:seed

##その他記述
　認証メールの確認には MailCatcher を使用しています。

認証メールを確認する場合は「http://localhost:1080/」にアクセスしてください。
