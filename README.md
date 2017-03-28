Дипломна робота 
============================


### Для того щоб запустити проект потрібно встановити Composer

Детальніша інформація за силкою [Composer](http://getcomposer.org/),інструкція по встановленню [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Після встановлення composer потрібно зайти на проект і виконати команду:

~~~
composer install
~~~



### Налаштування підключення до бази

Відкриваємо файл `config/db.php` і вводимо налаштування клнекту до бази:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

Після підключення до бази виконуємо міграцію:

~~~
yii migrate
~~~