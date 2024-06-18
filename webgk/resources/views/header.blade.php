<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Layout</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" />
            <span>PK Computer</span>
        </div>
        <nav class="navigation-menu">
            <ul>
                <li><a href="{{ route('products.index') }}">Trang chủ</a></li>
                <li><a href="{{ route('products.index') }}">Sản phẩm</a></li>
                <li><a href="{{ route('products.index') }}">Dịch vụ</a></li>
                <li><a href="{{ route('products.index') }}">Khuyến mãi</a></li>
                <li><a href="{{ route('products.index') }}">Liên hệ</a></li>
                <li><a href="{{ route('products.index') }}">Hỗ trợ</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>
