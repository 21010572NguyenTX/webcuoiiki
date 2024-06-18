<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // Lấy từ khóa tìm kiếm và mức giá từ request
    $search = $request->input('search');
    $price_range = $request->input('price_range');

    // Tạo query với điều kiện
    $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })
        ->when($price_range, function ($query, $price_range) {
            switch ($price_range) {
                case '5-10':
                    return $query->whereBetween('price', [5000000, 10000000]);
                case '11-30':
                    return $query->whereBetween('price', [11000000, 30000000]);
                case '31-50':
                    return $query->whereBetween('price', [31000000, 50000000]);
                case '50+':
                    return $query->where('price', '>', 50000000);
                default:
                    return $query;
            }
        })
        ->paginate(6); // Lấy 6 sản phẩm mỗi trang

    // Trả về view products.index với danh sách sản phẩm và thông tin phân trang
    return view('products.index', compact('products', 'search', 'price_range'));
}




    public function create() 
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048', // Chấp nhận thêm định dạng webp
        ]);

        $path = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
    

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
        } else {
            $path = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
