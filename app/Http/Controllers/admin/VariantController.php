<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = Variant::with('product')->get();
        return view('admin.variant.index', compact('variants'));
    }

    public function create()
    {
        $products = Product::where('status', 0)->get();
        return view('admin.variant.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'storage' => 'required|string',
            'color' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        Variant::create($request->all());

        return redirect()->route('admin.variants.index')
            ->with('success', 'Thêm biến thể thành công');
    }

    public function edit(Variant $variant)
    {
        $products = Product::all();
        return view('admin.variant.edit', compact('variant', 'products'));
    }

    public function update(Request $request, Variant $variant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'storage' => 'required|string',
            'color' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $variant->update($request->all());

        return redirect()->route('admin.variants.index')
            ->with('success', 'Cập nhật biến thể thành công');
    }

    public function destroy(Variant $variant)
    {
        $variant->delete();

        return redirect()->route('admin.variants.index')
            ->with('success', 'Xóa biến thể thành công');
    }
}