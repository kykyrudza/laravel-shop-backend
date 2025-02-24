# Розгортання проєкту

## Вимоги

Перед початком роботи переконайтеся, що у вас встановлені такі залежності:

- **PHP** версії **8.2** або вище
- **Composer** (бажано останньої версії)
- **Node.js** версії **20.17.0** і **npm** версії **11.1.0**

## Встановлення

1. **Клонування репозиторію**

   Клонуйте проєкт у локальну директорію:
   ```bash
   git clone https://github.com/kykyrudza/laravel-shop-backend
   ```
   Перейдіть у папку з проєктом:
   ```bash
   cd laravel-shop-backend
   ```

2. **Встановлення залежностей**

   Встановіть залежності PHP через Composer:
   ```bash
   composer install
   ```

   Встановіть залежності Node.js через npm:
   ```bash
   npm install
   ```

3. **Створення та налаштування файлу `.env`**

   Створіть `.env`-файл, скопіювавши `.env.example`:
   ```bash
   cp .env.example .env
   ```

   Згенеруйте унікальний ключ застосунку:
   ```bash
   php artisan key:generate
   ```

   Створіть символічне посилання на папку `storage`:
   ```bash
   php artisan storage:link
   ```

4. **Налаштування бази даних**

   Створіть таблиці у базі даних:
   ```bash
   php artisan migrate
   ```

   Якщо потрібно заповнити базу тестовими даними, використовуйте:
   ```bash
   php artisan migrate:refresh --seed
   ```

5. **Запуск сервера**

   Запустіть локальний сервер Laravel:
   ```bash
   php artisan serve
   ```

   Запустіть Vite для збирання frontend-частини:
   ```bash
   npm run dev
   ```

## Налаштування `.env`

### Основні параметри, які можна змінити:
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=назва_бази_даних
DB_USERNAME=ім'я_користувача
DB_PASSWORD=пароль_бази_даних
```
Ці параметри можна налаштувати відповідно до ваших потреб перед запуском проєкту.

### Якщо хочеш запустити проєкт у **production**-режимі:

### 1. **`APP_ENV` і `APP_DEBUG`**
У файлі `.env` має бути:
```ini
APP_ENV=production
APP_DEBUG=false
```
Обов’язкове очищення кешу конфігурації:
```sh
php artisan config:clear
php artisan config:cache
```

Проєкт працюватиме у **production**-режимі.

---

### 3. **Оптимізація застосунку**
```sh
php artisan optimize:clear
composer install --optimize-autoloader --no-dev
```
