<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Lưu đơn hàng
    public function index()
    {
        return view('clients.checkout');
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

        // Lưu đơn hàng vào cơ sở dữ liệu
        $order = new Order();
        $order->user_id = Auth::id();  // Lấy user đã đăng nhập
        $order->ho_va_ten = $request->ho_va_ten;
        $order->dia_chi = $request->dia_chi;
        $order->so_dien_thoai = $request->so_dien_thoai;
        $order->trang_thai = 'Chờ xử lý';
        $order->phuong_thuc_thanh_toan = $request->phuong_thuc_thanh_toan;
        $order->tong_tien = $this->calculateTotalAmount();  // Tính tổng tiền từ giỏ hàng
        $order->save();
        return redirect()->route('payment.form', ['order' => $order->id]);
    }
    public function calculateTotalAmount()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $productId => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        return $total;
    }
//     public function show($orderId)
// {
//     // Lấy thông tin đơn hàng và chi tiết đơn hàng
//     $order = Order::find($orderId);

//     // Kiểm tra nếu đơn hàng không tồn tại
//     if (!$order) {
//         return redirect()->route('home')->with('error', 'Đơn hàng không tồn tại!');
//     }

//     // Lấy chi tiết đơn hàng
//     $orderDetails = OrderDetail::where('order_id', $orderId)->get();

//     // Trả về view với thông tin đơn hàng và chi tiết đơn hàng
//     return view('clients.show-order', compact('order', 'orderDetails'));
// }
}
