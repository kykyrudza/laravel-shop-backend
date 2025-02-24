# Разворачивание проекта

## Требования

Перед началом работы убедитесь, что у вас установлены следующие зависимости:

- **PHP** версии **8.2** или выше
- **Composer** (желательно последней версии)
- **Node.js** версии **20.17.0** и **npm** версии **11.1.0**

## Установка

1. **Клонирование репозитория**

   Склонируйте проект в локальную директорию:
   ```bash
   git clone https://github.com/kykyrudza/laravel-shop-backend
   ```
   Перейдите в папку с проектом:
   ```bash
   cd laravel-shop-backend
   ```

2. **Установка зависимостей**

   Установите зависимости PHP через Composer:
   ```bash
   composer install
   ```

   Установите зависимости Node.js через npm:
   ```bash
   npm install
   ```

3. **Создание и настройка файла `.env`**

   Создайте `.env`-файл, скопировав `.env.example`:
   ```bash
   cp .env.example .env
   ```

   Сгенерируйте уникальный ключ приложения:
   ```bash
   php artisan key:generate
   ```

   Создайте символическую ссылку на папку `storage`:
   ```bash
   php artisan storage:link
   ```

4. **Настройка базы данных**

   Создайте таблицы в базе данных:
   ```bash
   php artisan migrate
   ```

   Если требуется наполнить базу тестовыми данными, используйте:
   ```bash
   php artisan migrate:refresh --seed
   ```

5. **Запуск сервера**

   Запустите локальный сервер Laravel:
   ```bash
   php artisan serve
   ```

   Запустите Vite для сборки frontend-части:
   ```bash
   npm run dev
   ```

## Настройки `.env`

### Основные параметры, которые можно изменить:
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=имя_базы_данных
DB_USERNAME=имя_пользователя
DB_PASSWORD=пароль_базы_данных
```
Эти параметры можно настроить под свои нужды перед запуском проекта.

### Если хочешь запустить проект в **production**-режиме:

### 1. **`APP_ENV` и  `APP_DEBUG`**
В файле `.env` должно быть:
```ini
APP_ENV=production
APP_DEBUG=false
```
Обязательная очистка кеш конфигурации:
```sh
php artisan config:clear
php artisan config:cache
```

Проект будет работать в **production**-режиме.ів

---

### 3. **Оптимизация приложения**
```sh
php artisan optimize:clear
composer install --optimize-autoloader --no-dev
```
