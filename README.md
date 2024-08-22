# Запуск проекта

## Завсисимости:
* PHP 8.3
* Composer
* Docker
## 1. Установка
* Склонировать git-репозиторий
* Скопировать .env.example файл с новым именем .env
* Заполнить доступы к Mail и БД
* Выполнить команду ```composer install```
* Выполнить команду ```php artisan key:generate```
* Для запуска проекта выполняем команду ```./vendor/bin/sail up -d```
* Для запуска миграций выполняем команду ```./vendor/bin/sail artisan migrate:refresh --seed```
* Открываем 0.0.0.0
