@include('clients.header')

<div class="order-detail-container">
    @if(isset($order) && $order)
        <div class="order-card">
            <!-- Header -->
            <div class="order-header">
                <div class="order-number">
                    <h1>Đơn hàng #{{ $order->id }}</h1>
                    <span class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="order-status">
                    <span class="status-badge {{ $order->trang_thai == 'Đã giao' ? 'delivered' : ($order->trang_thai == 'Đang xử lý' ? 'processing' : 'pending') }}">
                        {{ $order->trang_thai }}
                    </span>
                </div>
            </div>

            <!-- Order Progress -->
            <div class="order-progress">
                <div class="progress-steps">
                    <div class="step {{ $order->trang_thai == 'Đã giao' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="step-label">Đặt hàng</div>
                    </div>
                    <div class="step {{ $order->trang_thai == 'Đang xử lý' || $order->trang_thai == 'Đã giao' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="step-label">Xử lý</div>
                    </div>
                    <div class="step {{ $order->trang_thai == 'Đã giao' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="step-label">Vận chuyển</div>
                    </div>
                    <div class="step {{ $order->trang_thai == 'Đã giao' ? 'completed' : '' }}">
                        <div class="step-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="step-label">Hoàn thành</div>
                    </div>
                </div>
            </div>

            <!-- Order Info -->
            <div class="order-info-grid">
                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-content">
                        <h3>Thông tin khách hàng</h3>
                        <p><strong>Tên:</strong> {{ $order->ho_va_ten }}</p>
                        <p><strong>Điện thoại:</strong> {{ $order->so_dien_thoai }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->dia_chi }}</p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="info-content">
                        <h3>Thông tin thanh toán</h3>
                        <p><strong>Phương thức:</strong> {{ $order->phuong_thuc_thanh_toan }}</p>
                        <p><strong>Tổng tiền:</strong> <span class="price">{{ number_format($order->tong_tien) }} VND</span></p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="order-items">
                <h2>Chi tiết đơn hàng</h2>
                <div class="items-list">
                    @foreach($order->orderDetails as $item)
                    <div class="item-card">
                        <div class="item-image">
                            <img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}">
                        </div>
                        
                        <div class="item-details">
                            <h3>{{ $item->product->name }}</h3>
                            <div class="item-variants">
                                <span class="variant">
                                    <i class="fas fa-mobile-alt"></i>
                                    {{ $item->storage }}
                                </span>
                                <span class="variant">
                                    <i class="fas fa-palette"></i>
                                    <span class="color-dot" style="background-color: {{ $item->color }}"></span>
                                    {{ $item->color }}
                                </span>
                            </div>
                            <div class="item-price">
                                <span class="quantity">x{{ $item->quantity }}</span>
                                <span class="price">{{ number_format($item->price * $item->quantity) }} VND</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="summary-item">
                    <span>Tổng tiền hàng</span>
                    <span>{{ number_format($order->tong_tien) }} VND</span>
                </div>
                <div class="summary-item">
                    <span>Phí vận chuyển</span>
                    <span>Miễn phí</span>
                </div>
                <div class="summary-item total">
                    <span>Tổng thanh toán</span>
                    <span>{{ number_format($order->tong_tien) }} VND</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="{{ route('orders.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                @if($order->trang_thai == 'Đang xử lý')
                <button class="btn-cancel">Hủy đơn hàng</button>
                @endif
            </div>
        </div>
    @else
        <div class="no-order">
            <i class="fas fa-exclamation-circle"></i>
            <h2>Không tìm thấy đơn hàng</h2>
            <p>Đơn hàng bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <a href="{{ route('orders.index') }}" class="btn-back">Quay lại danh sách đơn hàng</a>
        </div>
    @endif
</div>

@include('clients.footer')

<style>
.order-detail-container {
    padding: 40px;
    background: #f8f9fa;
    min-height: 100vh;
}

.order-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    max-width: 1200px;
    margin: 0 auto;
}

.order-header {
    padding: 30px;
    background: linear-gradient(135deg, #6c5ce7, #a29bfe);
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-number h1 {
    margin: 0;
    font-size: 28px;
    font-weight: 700;
}

.order-date {
    opacity: 0.8;
    font-size: 14px;
}

.status-badge {
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 14px;
}

.status-badge.delivered {
    background: #00b894;
}

.status-badge.processing {
    background: #fdcb6e;
}

.status-badge.pending {
    background: #d63031;
}

.order-progress {
    padding: 30px;
    background: white;
    border-bottom: 1px solid #eee;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: #eee;
    z-index: 1;
}

.step {
    position: relative;
    z-index: 2;
    text-align: center;
}

.step-icon {
    width: 40px;
    height: 40px;
    background: white;
    border: 2px solid #eee;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 10px;
    color: #999;
}

.step.completed .step-icon {
    background: #6c5ce7;
    border-color: #6c5ce7;
    color: white;
}

.step-label {
    font-size: 12px;
    color: #666;
}

.order-info-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 30px;
}

.info-card {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
}

.info-icon {
    width: 40px;
    height: 40px;
    background: #6c5ce7;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 15px;
}

.info-content h3 {
    margin: 0 0 10px;
    font-size: 16px;
    color: #333;
}

.info-content p {
    margin: 5px 0;
    color: #666;
}

.order-items {
    padding: 30px;
    border-top: 1px solid #eee;
}

.order-items h2 {
    margin-bottom: 20px;
    font-size: 20px;
    color: #333;
}

.items-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.item-card {
    display: flex;
    align-items: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
}

.item-image {
    width: 80px;
    height: 80px;
    margin-right: 20px;
}

.item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.item-details {
    flex: 1;
}

.item-details h3 {
    margin: 0 0 10px;
    font-size: 16px;
    color: #333;
}

.item-variants {
    display: flex;
    gap: 15px;
    margin-bottom: 10px;
}

.variant {
    display: flex;
    align-items: center;
    color: #666;
    font-size: 14px;
}

.variant i {
    margin-right: 5px;
    color: #6c5ce7;
}

.color-dot {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    margin-right: 5px;
    border: 1px solid #ddd;
}

.item-price {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.quantity {
    color: #666;
}

.price {
    font-weight: 600;
    color: #333;
}

.order-summary {
    padding: 30px;
    background: #f8f9fa;
    border-radius: 0 0 20px 20px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    color: #666;
}

.summary-item.total {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.action-buttons {
    padding: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-back {
    display: flex;
    align-items: center;
    color: #6c5ce7;
    text-decoration: none;
    font-weight: 600;
}

.btn-back i {
    margin-right: 8px;
}

.btn-cancel {
    padding: 10px 20px;
    background: #ff4757;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.no-order {
    text-align: center;
    padding: 50px;
}

.no-order i {
    font-size: 60px;
    color: #6c5ce7;
    margin-bottom: 20px;
}

.no-order h2 {
    color: #333;
    margin-bottom: 10px;
}

.no-order p {
    color: #666;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .order-detail-container {
        padding: 20px;
    }

    .order-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .order-info-grid {
        grid-template-columns: 1fr;
    }

    .item-card {
        flex-direction: column;
        text-align: center;
    }

    .item-image {
        margin: 0 0 15px;
    }

    .item-variants {
        justify-content: center;
    }

    .action-buttons {
        flex-direction: column;
        gap: 15px;
    }
}
</style>