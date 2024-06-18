@extends('app')

@section('title', 'Show')
@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')

<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart"></i> <!-- Sử dụng Bootstrap Icons -->
                            <span class="badge badge-pill badge-danger">
                                {{ session('cart') ? count(session('cart')) : 0 }}
                            </span>
                        </a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <span class="navbar-text">
                                Xin chào, {{ Auth::user()->name }}
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.create') }}">Thêm sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
        
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