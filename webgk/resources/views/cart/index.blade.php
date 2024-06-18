@extends('app')

@section('title', 'Giỏ hàng của bạn')
@section('styles')
<link rel="stylesheet" href="{{ asset('css/cart.css') }}">
<style></style>
@endsection
@section('content')
<div class="container">
    <h2 class="my-4">Your Cart</h2>

    @if(session('cart') && count(session('cart')) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach(session('cart') as $id => $details)
            <tr>
                <td>
                    <div class="product-info">
                        <img src="{{ asset('storage/' . $details['image']) }}" alt="Product Image">
                        <a href="{{ route('products.show', $id) }}">{{ $details['name'] }}</a>
                    </div>
                </td>
                <td>
                    <input type="number" name="quantity" value="{{ $details['quantity'] }}" min="1" class="form-control quantity-input" data-id="{{ $id }}">
                </td>
                <td>{{ number_format($details['price'], 0, ',', '.') }}₫</td>
                <td class="item-total">{{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}₫</td>
                <td>
                    <!-- Form xóa sản phẩm khỏi giỏ hàng -->
                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('cart.checkoutPage') }}" class="a">Thanh toán</a>
    @else
    <p>Your cart is empty!</p>
    @endif
</div>

<script>
    // JavaScript để cập nhật số lượng và tổng tiền
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            let id = this.dataset.id;
            let quantity = this.value;
            let url = '{{ url("cart/update") }}/' + id;

            fetch(url, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let row = input.closest('tr');
                        let price = parseInt(row.querySelector('td:nth-child(3)').textContent.replace(/[^0-9]/g, ''));
                        let total = price * quantity;
                        row.querySelector('.item-total').textContent = new Intl.NumberFormat('vi-VN').format(total) + '₫';

                        // Cập nhật số lượng sản phẩm trong giỏ hàng (navbar)
                        document.querySelector('.navbar-nav .cart-count').textContent = data.cartCount;
                    }
                });
        });
    });
</script>
@endsection