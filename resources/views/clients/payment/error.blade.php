@include('clients.header')

<div class="payment-result-container">
    <div class="payment-result-card error">
        <div class="result-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <h2 class="result-title">Thanh Toán Thất Bại</h2>
        <p class="result-message">Đã có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại hoặc liên hệ hỗ trợ.</p>
        <div class="result-actions">
            <a href="{{ route('payment.form', ['order' => $order->id]) }}" class="btn-primary">Thử lại</a>
            <a href="{{ route('home') }}" class="btn-secondary">Quay về trang chủ</a>
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
    color: #e74c3c;
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
