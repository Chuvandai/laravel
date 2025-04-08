<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:0,1'
        ]);

        Category::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'required|in:0,1'
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        
        // Kiểm tra xem danh mục có sản phẩm không
        if ($category->product()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Không thể xóa danh mục này vì đang có sản phẩm liên quan');
        }
        
        $category->delete();
        return redirect()->route('admin.categories.index')
            ->with('success', 'Xóa danh mục thành công');
    }

    public function showProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->paginate(12);
        $categories = Category::all();

        return view('clients.category-products', compact('category', 'products', 'categories'));
    }
}
