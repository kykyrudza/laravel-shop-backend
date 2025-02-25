@extends('layout.app')

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
        {{ $products->links('vendor.pagination.custom') }}
    </div>
@endsection
