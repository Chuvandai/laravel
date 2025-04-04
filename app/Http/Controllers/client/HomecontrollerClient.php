<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Banner;
use App\Models\Order;
use App\Models\Variant;
use Illuminate\Support\Facades\Auth;

class HomecontrollerClient extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh mục và banner
        $categories = Category::where('status', 0)->get();
        $banners = Banner::where('status', 0)->get();

        // Khởi tạo query builder cho products
        $productsQuery = Product::where('status', 0);

        // Kiểm tra nếu có tham số tìm kiếm tên sản phẩm
        if ($request->has('search')) {
            $productsQuery->where('name', 'like', '%' . $request->search . '%');
        }

        // Kiểm tra nếu có tham số lọc theo giá
        if ($request->has('min_price') && is_numeric($request->min_price)) {
            $productsQuery->where('price', '>=', $request->min_price); // Lọc giá lớn hơn hoặc bằng min_price
        }

        if ($request->has('max_price') && is_numeric($request->max_price)) {
            $productsQuery->where('price', '<=', $request->max_price); // Lọc giá nhỏ hơn hoặc bằng max_price
        }

        // Lấy danh sách sản phẩm sau khi áp dụng các điều kiện lọc
        $products = $productsQuery->get();

        // Trả dữ liệu về view
        return view('clients.index', compact('categories', 'products', 'banners'));
    }

    public function show($id)
    {
        // Lấy sản phẩm theo ID
        $product = Product::findOrFail($id);

        // Lấy 5 sản phẩm ngẫu nhiên từ cơ sở dữ liệu
        $relatedProducts = Product::where('status', 0)  // Chỉ lấy sản phẩm có trạng thái hoạt động
            ->inRandomOrder()  // Lấy ngẫu nhiên
            ->limit(5)  // Giới hạn số lượng là 5 sản phẩm
            ->get();

        return view('clients.show', compact('product', 'relatedProducts'));
    }
    public function login()
    {
        return view('clients.login');
    }
    public function showOrder()
    {
        // Lấy danh sách đơn hàng của người dùng đã đăng nhập
        $orders = Order::where('user_id', Auth::id())->get();

        // Trả về view với danh sách đơn hàng
        return view('clients.index', compact('orders'));
    }
}
