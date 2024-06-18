<?php

// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        // Hiển thị giỏ hàng
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add($id)
    {
        // Thêm sản phẩm vào giỏ hàng
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');
    
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
    
            // Tính toán số lượng sản phẩm trong giỏ hàng
            $cartCount = array_sum(array_column($cart, 'quantity'));
    
            return response()->json(['success' => true, 'cartCount' => $cartCount]);
        }
    
        return response()->json(['success' => false]);
    }
    

    public function remove($id)
    {
        // Xóa sản phẩm khỏi giỏ hàng
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function checkoutPage()
    {
        $cart = session()->get('cart', []); // Lấy giỏ hàng từ session

        return view('cart.checkout', compact('cart')); // Trả về view thanh toán
    }

    // Phương thức xử lý logic thanh toán
    public function completeCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Xử lý logic thanh toán (bạn có thể tích hợp các dịch vụ thanh toán thực tế ở đây)

        // Xóa giỏ hàng sau khi thanh toán
        session()->forget('cart');

        // Chuyển hướng tới trang xác nhận hoặc cảm ơn
        return redirect()->route('products.index')->with('success', 'Thanh toán thành công! Cảm ơn bạn đã mua hàng.');
    }
    
}

