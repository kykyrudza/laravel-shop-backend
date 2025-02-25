@extends('layout.app')

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
