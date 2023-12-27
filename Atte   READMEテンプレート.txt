＃アプリケーション名
Atte（アット）

＃＃作成した目的
〇ebサービス制作の概要・方針決定
サービス概要		ある企業の勤怠管理システム
制作の背景と目的		人事評価のため
制作の目標		利用者数100人達成
作業範囲		設計・コーディング・テスト
納品方法		GitHubでのコードの共有とサーバー設置



＃＃アプリケーションURL

http://localhost/

Git hub
https://github.com/mizukitasuku/20231207--Atte.git

/var/www/html/20231207--Atte/
AWX(途中) http://ec2-13-211-159-219.ap-southeast-2.compute.amazonaws.com


＃＃機能一覧
会員登録
ログイン
ログアウト
勤務開始
勤務終了
休憩開始
休憩終了
二付け別勤怠情報取得
ページネーション
認証
ユーザーページ


＃＃使用技術(実行環境)
docker-compose.yml  	version: '3.8'
nginx:1.21.1
mysql:8.0.26
PHP:7.4.9 
phpMyAdmin:phpmyadmin/phpmyadmin
Composer : 2.6.2
Laravel : 8.83.27 
Windows 11 Home

＃＃テーブル設計
googleスプレットシート
https://docs.google.com/spreadsheets/d/1kUO03tsHsdejZKX6peMnMjwKIL40AQ3DNQzzrv5Nvcw/edit?usp=sharing

＃＃ER図
作成出来ず

＃＃他に記載することがあれば記述する
思ったより作業を進めることが出来ませんでした。
実装は一通りできたと思いますが、コーティングやER図の作成,
ほぼほぼ出来ておらず…
AWSの使用後に対応予定でしたが思った以上に
掛かってしまいました。