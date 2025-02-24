Вот перевод на английский:

---

# **E-Commerce Backend System in Laravel (Development!!!)**

This project is created **exclusively for educational purposes**. It is **not intended** for high-load applications and **should not** be used as a foundation for commercial solutions.

---

## **Project Goal**
The project provides a ready-to-use backend base for beginner (or experienced) developers working with frontend. It allows practicing the development of fully functional applications without the need to understand Laravel's server-side logic.

## **Project Structure**

### **1. `app/` — Backend Logic (Do Not Modify!)**
The main Laravel code is located here. **Files in this directory should not be modified!**

### **2. `config/` — Application Configuration**
Configuration files for the system. **Changing configurations without understanding their purpose can be dangerous!**

#### **2.1 `config/locales.php` — Available Locales**
This file defines the list of supported languages for the application:

```php
<?php  

return [  
    'available_locales' => ['ru', 'en'],  
];  
```  

### **3. `resources/lang/` — Translation Files**
This directory contains translation files for supported languages. For example, `resources/lang/en/app.php`:

```php
<?php  

return [  
    'change_locale' => 'Switch language to',  
    'languages' => [  
        'en' => 'English',  
        'ru' => 'Russian',  
    ],  
];  
```  

---

## **Using Localization in Blade**

### **1. Displaying Translated Strings**
In `Blade` templates, use the `__()` function, passing the path to the string in the array using dot notation:

```blade
<p>{{ __('app.change_locale') }}</p>  
```  

### **2. Localization of Dynamic Values**

```blade
<p>{{ __('app.languages.en') }}</p>  
```  
This code will display **"English"** (if Russian is selected as the locale).

### **3. Switching Language via a Form**

Example dropdown for selecting a language:

```blade
<form action="{{ route('locale.change') }}" method="POST">  
    @csrf  
    <select name="locale" onchange="this.form.submit()">  
        @foreach(config('locales.available_locales') as $locale)  
            <option value="{{ $locale }}" {{ app()->getLocale() === $locale ? 'selected' : '' }}>  
                {{ __('app.languages.' . $locale) }}  
            </option>  
        @endforeach  
    </select>  
</form>  
```  

### **4. Displaying Error Messages and Notifications**

Message files:
- Errors: `resources/lang/{locale}/errors.php`
- Success messages: `resources/lang/{locale}/success.php`

To display notifications via session, add this code to the template:

```blade
@if (session('success'))  
    <p class="text-green-500">{{ session('success') }}</p>  
@endif  

@if (session('error'))  
    <p class="text-red-500">{{ session('error') }}</p>  
@endif  
```  

---

## **Adding a New Language**

1. **Add the language to `config/locales.php`**:

```php
'available_locales' => ['ru', 'en', 'ua', 'fr'],  
```  

2. **Create a folder `resources/lang/fr/`**.
3. **Copy files from `resources/lang/ru/` and translate them**.
4. **Add the new language to all `app.php` files in `resources/lang/{locale}/`**.
5. **Done! Laravel will now automatically recognize the new language**.

---

## **Displaying Content Based on User Status**

### **1. Content for Authenticated Users**

Use the `@auth` directive:

```blade
@auth()  
    <p>You are logged in!</p>  
@endauth  
```  

### **2. Content for Guests**

Use the `@guest` directive:

```blade
@guest()  
    <p>You are a guest, please log in!</p>  
@endguest  
```  

---

## **Routing and Navigation**

### **1. Using Named Routes**

```blade
<a href="{{ route('home') }}">Home</a>  
```  

### **2. Dynamic Parameters in Routes**

```blade
<a href="{{ route('product.show', ['id' => $product->id]) }}">View Product</a>  
```  

### **3. Routes and Their Parameters**
After the project is completed, a table with all routes, their views, and parameters will be provided.

---

🔹 **This project provides a ready-to-use backend base. No need to modify PHP code!**  
