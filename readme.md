####laravel-breadcrumbsの使い方
https://github.com/davejamesmiller/laravel-breadcrumbs

####laravel-breadcrumbsをインストール
````
composer require davejamesmiller/laravel-breadcrumbs
````

####routes/breadcrumbs.phpを作成
````
touch routes/breadcrumbs.php
````

####breadcrumbs の設定ファイルを生成(config/breadcrumbs.php)
````
php artisan vendor:publish --provider="DaveJamesMiller\Breadcrumbs\BreadcrumbsServiceProvider"
````
