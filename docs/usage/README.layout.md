# Страница всех продуктов

```php
@extends('welcome')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <div class="row">

            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p class="card-text"><strong>Price:</strong> ${{ $product['price'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
```

# Кастомная пагинация

В Laravel можно выбрать свой шаблон пагинации, передав его в метод `links()`.

### 1. **Создайте кастомный шаблон пагинации**
Laravel использует Blade-шаблоны для отображения пагинации. По умолчанию они хранятся в `resources/views/vendor/pagination`.

Если этой папки нет, скопируйте туда стандартные шаблоны, выполнив:
```bash
php artisan vendor:publish --tag=laravel-pagination
```
Теперь у вас появятся файлы пагинации в `resources/views/vendor/pagination/`, такие как `bootstrap-4.blade.php`, `tailwind.blade.php` и другие.

### 2. **Создайте шаблон на основе других файлов пагинации**
Создайте нужный файл, например, `resources/views/vendor/pagination/custom.blade.php`, и измените его по своему усмотрению взяв за основу любой доступный файл из `resources/views/vendor/pagination/...`.

### 3. **Используйте кастомный шаблон в Blade**
Передайте имя кастомного шаблона в метод `links()`:
```blade
{{ $products->links('vendor.pagination.custom') }}
```
Это подключит ваш шаблон `resources/views/vendor/pagination/custom.blade.php`.

Таким образом, можно настроить внешний вид пагинации под свои нужды. 🚀


# Вывод продуктов + его категория + его параметры

```php
@extends('welcome')

@section('content')
    {{ $product->name }}
    <br>
    {{ $product->price }}

    <h2>Категория:</h2>
    <ul>
       {{ $product->category->name }}
    </ul>

    <h2>Параметры:</h2>
    <ul>
        @foreach($product->parameters as $parameter)
            {{ app()->getLocale()  }} - {{$parameter->getName()  }}<br>
            <br>
            {{ app()->getLocale()  }} - {{$parameter->getDescription()  }}<br>
        @endforeach
    </ul>
@endsection

```
# Смена пароля в профиле пользователя

``
name для форм
``
1. current_password
2. password
3. password_confirmation
