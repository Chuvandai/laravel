@include('clients.header')

<div class="orders-container">
    @if(isset($orders) && $orders->count() > 0)
        <h1 class="page-title">Danh sách đơn hàng của bạn</h1>
        <div class="orders-grid">
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-number">
                            <h2>Đơn hàng #{{ $order->id }}</h2>
                            <span class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="order-status">
                            <span class="status-badge {{ $order->trang_thai == 'Đã giao' ? 'delivered' : ($order->trang_thai == 'Đang xử lý' ? 'processing' : 'pending') }}">
                                {{ $order->trang_thai }}
                            </span>
                        </div>
                    </div>

                    <div class="order-content">
                        <div class="order-info">
                            <div class="info-item">
                                <i class="fas fa-user"></i>
                                <span>{{ $order->ho_va_ten }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $order->dia_chi ?? 'Không có' }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-phone"></i>
                                <span>{{ $order->so_dien_thoai }}</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-credit-card"></i>
                                <span>{{ $order->phuong_thuc_thanh_toan ?? 'Không có' }}</span>
                            </div>
                        </div>

                        <div class="order-summary">
                            <div class="total-amount">
                                <span>Tổng tiền:</span>
                                <span class="amount">{{ number_format($order->tong_tien ?? 0) }} VND</span>
                            </div>
                        </div>
                    </div>

                    <div class="order-footer">
                        <a href="{{ route('order.show', $order->id) }}" class="btn-view-details">
                            <i class="fas fa-eye"></i> Xem chi tiết
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-orders">
            <i class="fas fa-shopping-bag"></i>
            <h2>Bạn chưa có đơn hàng nào</h2>
            <p>Hãy bắt đầu mua sắm và tạo đơn hàng đầu tiên của bạn!</p>
            <a href="{{ route('home') }}" class="btn-shopping">Tiếp tục mua sắm</a>
        </div>
    @endif
</div>

@include('clients.footer')

<style>
.orders-container {
    padding: 40px;
    background: #f8f9fa;
    min-height: 100vh;
}

.page-title {
    text-align: center;
    color: #333;
    margin-bottom: 40px;
    font-size: 32px;
    font-weight: 700;
}

.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
}

.order-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

.order-header {
    padding: 20px;
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number h2 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.order-date {
    font-size: 12px;
    opacity: 0.8;
}

.status-badge {
    padding: 6px 15px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
}

.status-badge.delivered {
    background: #00b894;
}

.status-badge.processing {
    background: #fdcb6e;
    color: #333;
}

.status-badge.pending {
    background: #d63031;
}

.order-content {
    padding: 20px;
}

.order-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-bottom: 20px;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #666;
}

.info-item i {
    color: #6c5ce7;
    width: 20px;
    text-align: center;
}

.order-summary {
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.total-amount {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 16px;
}

.total-amount .amount {
    font-weight: 600;
    color: #333;
}

.order-footer {
    padding: 20px;
    border-top: 1px solid #eee;
    text-align: right;
}

.btn-view-details {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 20px;
    background: #6c5ce7;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-view-details:hover {
    background: #5b4bc4;
    transform: translateY(-2px);
}

.no-orders {
    text-align: center;
    padding: 50px;
}

.no-orders i {
    font-size: 60px;
    color: #6c5ce7;
    margin-bottom: 20px;
}

.no-orders h2 {
    color: #333;
    margin-bottom: 10px;
}

.no-orders p {
    color: #666;
    margin-bottom: 20px;
}

.btn-shopping {
    display: inline-block;
    padding: 12px 30px;
    background: #6c5ce7;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-shopping:hover {
    background: #5b4bc4;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .orders-container {
        padding: 20px;
    }

    .orders-grid {
        grid-template-columns: 1fr;
    }

    .order-info {
        grid-template-columns: 1fr;
    }
}
</style>
