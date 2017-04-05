
В composer.json добавляем в блок require
```json
 "vis/rating_l5": "1.0.*"
```

Выполняем
```json
composer update
```

Добавляем в app.php
```php
  Vis\Rating\RatingServiceProvider::class,
```

Выполняем миграцию таблиц
```json
   php artisan migrate --path=vendor/vis/rating_l5/src/Migrations
```

Публикуем js файлы
```json
   php artisan vendor:publish --tag=rating_public --force
```
-----------------------------------
Использование на фронтенде:

Подключаем в футере js и css файлы
```json
<link rel="stylesheet" type="text/css" href="/packages/vis/rating/font-awesome/font-awesome.min.css"/>
<link rel="stylesheet" type="text/css" href="/packages/vis/rating/jq-rating/jq-rating.css"/>
<script src="/packages/vis/rating/jq-rating/jq-rating.min.js"></script>
<script src="/packages/vis/rating/js/rating.js"></script>
```

Код на странице для голосования
```php
{!! Rating::showVote($page) !!}
```

Код на странице для просмотра рейтинга статьи
```php
{!! Rating::showResult($page) !!}
```
