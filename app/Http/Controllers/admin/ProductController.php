<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
        
    }

    public function create()
    {
        $categories = Category::where('status', 0)->get();
        if($categories->isEmpty()) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Không có danh mục nào đang hoạt động để thêm sản phẩm');
        }
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->status == 1) {
            return redirect()->back()
                ->with('error', 'Không thể thêm sản phẩm vào danh mục đang tạm dừng')
                ->withInput();
        }

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/products'), $imageName);

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => 'images/products/' . $imageName,
            'category_id' => $request->category_id,
            'status' => 0
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::where('status', 0)
            ->orWhere('id', $product->category_id)
            ->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);

        $category = Category::findOrFail($request->category_id);
        if ($category->status == 1) {
            return redirect()->back()
                ->with('error', 'Không thể chuyển sản phẩm vào danh mục đang tạm dừng')
                ->withInput();
        }

        $product = Product::findOrFail($id);
        
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id
        ];

        if ($request->hasFile('image')) {
            if (file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/' . $imageName;
        }

        $product->update($data);
        return redirect()->route('admin.products.index')
            ->with('success', 'Cập nhật sản phẩm thành công');
    }

public function show($id)
{
    $product = Product::findOrFail($id);
    // $relatedProducts = Product::where('id', '!=', $id) 
    //     ->inRandomOrder() // Lấy ngẫu nhiên
    //     ->limit(5) // Giới hạn 5 sản phẩm
    //     ->get();
    return view('clients.show', compact('product', 'relatedProducts'));
}

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if (file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', 'Xóa sản phẩm thành công');
    }
}
