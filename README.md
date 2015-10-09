# yii2-settings

Модуль настроек сайта

```
php composer.phar require --prefer-dist octoweb/yii2-settings "*"
```
или
```
"octoweb/yii2-settings": "*"
```
Запуск миграции
```php
yii migrate/up --migrationPath=@vendor/octoweb/yii2-settings/migrations
```
.

backend
-------
```php
<?php
    ......
   'modules' => [
        'settings' => [
            'class' => 'octoweb\settings\Module',
        ]
    ],
    ......

?>
```
доступ /settings/default/index

common
-------
```php
<?php
    ......
   'components' => [
        'setting'=>[
            'class'=>'octoweb\settings\components\SettingSite'
        ]
    ]
    ......

?>
```
использование
```php
<?=Yii::$app->setting->get('site','favicon')?>
```
