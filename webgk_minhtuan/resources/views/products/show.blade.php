@extends('layouts.app')

@section('content')
<div class="container">
    <div class="product-detail">
        <h1>{{ $product->name }}</h1>
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        <p class="product-description">
            {!! nl2br(e($product->description)) !!}
        </p>
        <p class="product-price">
            Price: {{ number_format($product->price, 0, ',', '.') }}₫
        </p>
        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Add to Cart</a>
    </div>
</div>
@endsection
