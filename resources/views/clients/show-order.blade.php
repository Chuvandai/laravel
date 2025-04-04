@include('clients.header')

<div class="container">
    <h2>Chi tiết đơn hàng</h2>
    
    <!-- Thông tin đơn hàng -->
    <div class="order-info">
        <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
        <p><strong>Họ và tên:</strong> {{ $order->ho_va_ten }}</p>
        <p><strong>Địa chỉ giao hàng:</strong> {{ $order->dia_chi }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->so_dien_thoai }}</p>
        <p><strong>Phương thức thanh toán:</strong> {{ $order->phuong_thuc_thanh_toan }}</p>
        <p><strong>Trạng thái đơn hàng:</strong> {{ $order->trang_thai }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->tong_tien, 0, ',', '.') }} VNĐ</p>
    </div>
    <hr>
    <!-- Chi tiết sản phẩm trong đơn hàng -->
    <h3>Chi tiết sản phẩm</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ number_format($detail->price, 0, ',', '.') }} VNĐ</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }} VNĐ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <hr>
    <!-- Nút quay lại -->
    <a href="{{ route('home') }}" class="btn btn-secondary">Quay lại trang chủ</a>
</div>
@include('clients.footer')
