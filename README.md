# Elmikeev Analitica API

## Описание
Этот проект представляет собой [тестовое](https://github.com//cy322666/wb-api/blob/master/README.md) API для выгрузки 
данных по продажам, заказам, складам и доходам.

## Стек технологий
- PHP 8.1
- Laravel 8
- Laravel Octane (с RoadRunner)
- MySQL 8.0
- Docker/Docker Compose

## Установка

1. Склонируйте репозиторий:
   ```bash
   git clone https://github.com/Andrey-Yurchuk/elmikeev_analitica.git

2. Перейдите в директорию проекта:
    ```bash
   cd elmikeev_analitica

3. Запустите Docker Compose:
   ```bash
   docker-compose up -d

4. Установите зависимости:
   ```bash
   docker-compose exec app composer install

5. Выполните миграции:
   ```bash
   docker-compose exec app php artisan migrate

6. Запустите RoadRunner:
   ```bash
   docker-compose exec app php artisan octane:start --server="roadrunner" --host="0.0.0.0"

## Доступы к базе данных

Для работы с базой данных на хостинге предоставлены следующие доступы:

- Хост: h29222ov.beget.tech
- Имя базы данных: h29222ov_elm
- Пользователь: h29222ov_elm
- Пароль: 5m%mX0!a5src

### Таблицы в базе данных

- sales — таблица для сущности "Продажи"
- orders — таблица для сущности "Заказы"
- stocks — таблица для сущности "Склады"
- incomes — таблица для сущности "Доходы"
