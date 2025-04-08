<?php

namespace App\Http\Controllers\admin; 

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Hiển thị trang thanh toán
    public function index()
    {
        // Lấy tất cả đơn hàng của người dùng hiện tại
        $orders = Order::with('orderDetails')
                       ->where('user_id', Auth::id())
                       ->orderBy('created_at', 'desc')
                       ->get();
        return view('clients.order', compact('orders')); 
    }

    public function store(Request $request)
    {
        // Kiểm tra thông tin đặt hàng
        $request->validate([
            'ho_va_ten' => 'required|string',
            'dia_chi' => 'required|string',
            'so_dien_thoai' => 'required|string',
            'phuong_thuc_thanh_toan' => 'required|string',
        ]);

        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng trống!');
        }

        // Lưu đơn hàng vào cơ sở dữ liệu
        $order = new Order();
        $order->user_id = Auth::id();
        $order->ho_va_ten = $request->ho_va_ten;
        $order->dia_chi = $request->dia_chi;
        $order->so_dien_thoai = $request->so_dien_thoai;
        $order->trang_thai = 'Chờ xử lý';
        $order->phuong_thuc_thanh_toan = $request->phuong_thuc_thanh_toan;
        $order->tong_tien = $this->calculateTotalAmount();
        $order->save();

        // Lưu chi tiết đơn hàng
        foreach ($cart as $productId => $details) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'variant_id' => $details['variant_id'] ?? null,
                'so_luong' => $details['quantity'],
                'don_gia' => $details['price'],
                'thanh_tien' => $details['price'] * $details['quantity']
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        session()->forget('cart');

        // Chuyển hướng đến trang thanh toán
        return redirect()->route('payment.form', ['order' => $order->id]);
    }

    // Tính tổng tiền từ giỏ hàng
    public function calculateTotalAmount()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $productId => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return $total;
    }

    // Hiển thị chi tiết một đơn hàng
    public function show($orderId)
    {
        // Lấy thông tin đơn hàng cùng chi tiết
        $order = Order::with('orderDetails')->find($orderId);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('home')->with('error', 'Đơn hàng không tồn tại!');
        }

        // Trả về view với thông tin đơn hàng
        return view('clients.show-order', compact('order'));
    }
}