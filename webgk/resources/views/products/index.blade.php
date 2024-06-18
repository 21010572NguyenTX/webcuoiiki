@extends('app')

@section('title', 'Index')
@section('styles')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container" style="padding-top: 5px;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Product List</a>
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

    <h2 class="my-4">Product List</h2>

    <!-- Form tìm kiếm và phân loại -->
    <form class="filter-form" method="GET" action="{{ route('products.index') }}">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <input type="text" name="search" class="form-control" placeholder="Search by product name" value="{{ request('search') }}">
            </div>
            <div class="col-md-4 mb-3">
                <select name="price_range" class="form-control">
                    <option value="">Select Price Range</option>
                    <option value="5-10" {{ request('price_range') == '5-10' ? 'selected' : '' }}>5.000.000đ - 10.000.000đ</option>
                    <option value="11-30" {{ request('price_range') == '11-30' ? 'selected' : '' }}>11.000.000đ - 30.000.000đ</option>
                    <option value="31-50" {{ request('price_range') == '31-50' ? 'selected' : '' }}>31.000.000đ - 50.000.000đ</option>
                    <option value="50+" {{ request('price_range') == '50+' ? 'selected' : '' }}>50.000.000đ+</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <button type="submit" class="btn btn-primary btn-block">Search</button>
            </div>
        </div>
    </form>

    <!-- Hiển thị thông báo thành công -->
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="product-container">
        @foreach($products as $product)
        <div class="product-card">
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            @endif
            <h5 class="product-name">
                <a href="{{ route('products.show', $product->id) }}">
                    {{ $product->name }}
                </a>
            </h5>
            <p class="product-description">
                {!! nl2br(e($product->description)) !!}
            </p>
            <span class="read-more">Xem thêm</span> <!-- Add the read more link -->
            <p class="product-price">
                <a href="{{ route('products.show', $product->id) }}">
                    Price: {{ number_format($product->price, 0, ',', '.') }}₫
                </a>
            </p>
            <div class="product-actions">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            </div>
            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary btn-sm buy-button">Mua hàng</a>
        </div>

        @endforeach
    </div>

    <!-- Đoạn mã hiển thị nút chuyển trang -->
    <div class="pagination-container">
        @if ($products->currentPage() > 1)
        <a href="{{ $products->previousPageUrl() }}" class="pagination-link">« Previous</a>
        @endif

        @foreach(range(1, $products->lastPage()) as $page)
        <a href="{{ $products->url($page) }}" class="pagination-link {{ $page == $products->currentPage() ? 'active' : '' }}">
            {{ $page }}
        </a>
        @endforeach

        @if ($products->hasMorePages())
        <a href="{{ $products->nextPageUrl() }}" class="pagination-link">Next »</a>
        @endif
    </div>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all the read more links
        const readMoreLinks = document.querySelectorAll('.read-more');

        // Attach click event to each link
        readMoreLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Find the corresponding product description
                const description = this.previousElementSibling;
                
                // Toggle the expanded class
                description.classList.toggle('expanded');
                
                // Change the text of the link based on the current state
                if (description.classList.contains('expanded')) {
                    this.textContent = 'Thu gọn'; // Collapsed state text
                } else {
                    this.textContent = 'Xem thêm'; // Expanded state text
                }
            });
        });
    });
</script>
@endsection