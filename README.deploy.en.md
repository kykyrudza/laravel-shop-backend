# Project Deployment

## Requirements

Before starting, make sure you have the following dependencies installed:

- **PHP** version **8.2** or higher
- **Composer** (preferably the latest version)
- **Node.js** version **20.17.0** and **npm** version **11.1.0**

## Installation

1. **Cloning the repository**

   Clone the project into a local directory:
   ```bash
   git clone https://github.com/kykyrudza/laravel-shop-backend
   ```
   Navigate to the project folder:
   ```bash
   cd laravel-shop-backend
   ```

2. **Installing dependencies**

   Install PHP dependencies via Composer:
   ```bash
   composer install
   ```

   Install Node.js dependencies via npm:
   ```bash
   npm install
   ```

3. **Creating and configuring the `.env` file**

   Create an `.env` file by copying `.env.example`:
   ```bash
   cp .env.example .env
   ```

   Generate a unique application key:
   ```bash
   php artisan key:generate
   ```

   Create a symbolic link to the `storage` folder:
   ```bash
   php artisan storage:link
   ```

4. **Database setup**

   Create tables in the database:
   ```bash
   php artisan migrate
   ```

   If you need to seed the database with test data, use:
   ```bash
   php artisan migrate:refresh --seed
   ```

5. **Starting the server**

   Start the Laravel local server:
   ```bash
   php artisan serve
   ```

   Start Vite to build the frontend:
   ```bash
   npm run dev
   ```

## `.env` Configuration

### Key parameters you can modify:
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database_name
DB_USERNAME=username
DB_PASSWORD=database_password
```
You can configure these settings according to your needs before launching the project.

### If you want to run the project in **production** mode:

### 1. **`APP_ENV` and `APP_DEBUG`**
In the `.env` file, set:
```ini
APP_ENV=production
APP_DEBUG=false
```
Clear and cache the configuration:
```sh
php artisan config:clear
php artisan config:cache
```

The project will now run in **production** mode.

---

### 3. **Application optimization**
```sh
php artisan optimize:clear
composer install --optimize-autoloader --no-dev
```
