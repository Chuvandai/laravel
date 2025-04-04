<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Hiển thị form thanh toán
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);  // Lấy thông tin đơn hàng
        return view('clients.payment', compact('order'));
    }

    // Lưu thông tin thanh toán
    public function store(Request $request, $orderId)
    {
        // Xác nhận và lưu thông tin thanh toán
        $request->validate([
            'ho_va_ten' => 'required|string',
            'dia_chi' => 'required|string',
            'so_dien_thoai' => 'required|string',
            'phuong_thuc_thanh_toan' => 'required|string',
        ]);

        $order = Order::findOrFail($orderId);
        $order->phuong_thuc_thanh_toan = $request->phuong_thuc_thanh_toan;
        $order->trang_thai = 'Chờ xử lý';  // Cập nhật trạng thái đơn hàng
        $order->save();
        return redirect()->route('payment.success', ['order' => $order->id]);
    }

    // Trang thanh toán thành công
    public function success($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('clients.payment-success', compact('order'));
    }
}
