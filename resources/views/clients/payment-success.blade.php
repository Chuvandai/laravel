@include('clients.header')

<div class="success-container">
    <div class="success-card">
        <div class="check-circle">
            <svg viewBox="0 0 24 24" class="check-icon">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
            </svg>
        </div>
        
        <h2 class="success-title">Thanh Toán Thành Công</h2>
        <p class="success-message">Cảm ơn bạn đã mua sắm! Đơn hàng của bạn đã được xử lý thành công.</p>
        
        <div class="order-details">
            <div class="detail-item">
                <span class="label">Mã đơn hàng:</span>
                <span class="value">{{ $order->id }}</span>
            </div>
            <div class="detail-item">
                <span class="label">Tổng tiền:</span>
                <span class="value">{{ number_format($order->tong_tien, 0, ',', '.') }} VND</span>
            </div>
            <div class="detail-item">
                <span class="label">Trạng thái:</span>
                <span class="value status">{{ $order->trang_thai }}</span>
            </div>
        </div>

        <a href="{{ route('home') }}" class="btn-home">Quay lại trang chủ</a>
    </div>
</div>

<style>
.success-container {
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    padding: 20px;
}

.success-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 40px;
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.check-circle {
    width: 80px;
    height: 80px;
    background: #28a745;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.check-icon {
    width: 40px;
    height: 40px;
    fill: white;
}

.success-title {
    color: #333;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 15px;
}

.success-message {
    color: #666;
    font-size: 16px;
    margin-bottom: 30px;
}

.order-details {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    margin: 15px 0;
    font-size: 16px;
}

.label {
    color: #555;
    font-weight: 500;
}

.value {
    color: #333;
    font-weight: 600;
}

.status {
    color: #28a745;
}

.btn-home {
    display: inline-block;
    padding: 12px 30px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 25px;
    font-weight: 500;
    transition: background 0.3s ease;
}

.btn-home:hover {
    background: #0056b3;
    color: white;
    text-decoration: none;
}
</style>