@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container">
        <h2 class="my-4">Checkout</h2>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="address">Địa chỉ nhận hàng</label>
                <input type="text" id="address" name="address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>

            <h4 class="my-4">Sản phẩm trong giỏ hàng</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php 
                            $subtotal = $details['price'] * $details['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td>{{ number_format($details['price'], 0, ',', '.') }}₫</td>
                            <td>{{ $details['quantity'] }}</td>
                            <td>{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right">Total:</th>
                        <th>{{ number_format($total, 0, ',', '.') }}₫</th>
                    </tr>
                </tfoot>
            </table>

            <button type="submit" class="btn btn-success btn-lg btn-block">Thanh toán</button>
        </form>
    </div>
@endsection
