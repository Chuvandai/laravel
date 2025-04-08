<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VnpayController extends Controller
{
    public function vnPay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('vnpay.return');
        $vnp_TmnCode = "QJKA8Y34";//Mã website tại VNPAY 
        $vnp_HashSecret = "U4XC9N25XP39IDVTC4QSO0XL1GX387B4"; //Chuỗi bí mật

        $cart = Session::get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($total < 5000 || $total >= 1000000000) {
            return redirect()->back()->with('error', 'Số tiền thanh toán phải từ 5,000đ đến dưới 1 tỷ đồng');
        }

        $orderData = [
            'user_id' => Auth::check() ? Auth::id() : null,
            'ho_va_ten' => $request->input('ho_va_ten'),
            'dia_chi' => $request->input('dia_chi'),
            'so_dien_thoai' => $request->input('so_dien_thoai'),
            'phuong_thuc_thanh_toan' => 'Thanh toán qua VNPay',
            'tong_tien' => $total,
            'trang_thai' => 'Chờ xử lý'
        ];

        $order = Order::create($orderData);

        $vnp_TxnRef = $order->id; //Mã đơn hàng
        $vnp_OrderInfo = 'Thanh toan don hang #' . $order->id;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $total * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_CreateDate = date('YmdHis');

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

        Session::forget('cart');
        return redirect($vnp_Url);
    }

    public function vnPayReturn(Request $request)
    {
        // Kiểm tra chữ ký
        $vnp_SecureHash = $request->vnp_SecureHash;
        $inputData = array();
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                if ($key != 'vnp_SecureHash') {
                    $inputData[$key] = $value;
                }
            }
        }
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $vnp_HashSecret = "U4XC9N25XP39IDVTC4QSO0XL1GX387B4";
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash == $vnp_SecureHash) {
            if ($request->vnp_ResponseCode == "00") {
                $order = Order::find($request->vnp_TxnRef);
                if ($order) {
                    $order->trang_thai = 'Đã xác nhận';
                    $order->save();
                    return view('clients.payment.success', ['order' => $order]);
                }
            }
        }
        
        $order = Order::find($request->vnp_TxnRef);
        if ($order) {
            $order->trang_thai = 'Hủy';
            $order->save();
        }
        return view('clients.payment.error', ['order' => $order]);
    }
}
