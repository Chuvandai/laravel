@include('clients.header')

<div class="payment-result-container">
    <div class="payment-result-card success">
        <div class="result-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <h2 class="result-title">Thanh Toán Thành Công</h2>
        <p class="result-message">Đơn hàng của bạn đã được thanh toán thành công. Cảm ơn bạn đã mua hàng!</p>
        <div class="result-actions">
            <a href="{{ route('orders.show', ['order' => $order->id]) }}" class="btn-primary">Xem đơn hàng</a>
            <a href="{{ route('home') }}" class="btn-secondary">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>

<style>
.payment-result-container {
    min-height: 80vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f4f6f9;
    padding: 20px;
}

.payment-result-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
    padding: 40px;
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.result-icon {
    margin-bottom: 20px;
    color: #2ecc71;
}

.result-title {
    color: #2c3e50;
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 15px;
}

.result-message {
    color: #7f8c8d;
    font-size: 16px;
    margin-bottom: 30px;
}

.result-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-primary {
    display: inline-block;
    padding: 12px 24px;
    background: #3498db;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.btn-primary:hover {
    background: #2980b9;
}

.btn-secondary {
    display: inline-block;
    padding: 12px 24px;
    background: #ecf0f1;
    color: #2c3e50;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s ease;
}

.btn-secondary:hover {
    background: #bdc3c7;
}
</style>
