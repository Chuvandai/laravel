@include('clients.header')

<div class="container mt-5">
    @if(isset($orders) && $orders->count() > 0)
        <h1 class="mb-4 fw-bold text-primary">Danh sách đơn hàng của bạn</h1>
        <div class="row g-4">
            @foreach($orders as $order)
                <div class="col-12"> <!-- Mỗi đơn hàng chiếm toàn bộ chiều rộng -->
                    <div class="card border-0">
                        <div class="card-header bg-primary text-white py-3">
                            <h2 class="mb-0 fw-bold">Đơn hàng #{{ $order->id }}</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-user me-3 text-primary"></i> <!-- Cách icon và text 1 chút -->
                                <div>
                                    <small class="text-muted">Tên khách hàng</small>
                                    <p class="mb-0 fw-semibold">{{ $order->ho_va_ten }}</p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Địa chỉ giao hàng</small>
                                    <p class="mb-0 fw-semibold">{{ $order->dia_chi ?? 'Không có' }}</p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-phone me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Số điện thoại</small>
                                    <p class="mb-0 fw-semibold">{{ $order->so_dien_thoai }}</p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-wallet me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Tổng tiền</small>
                                    <p class="mb-0 fw-bold text-danger">{{ number_format($order->tong_tien ?? 0) }} VND</p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-credit-card me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Phương thức thanh toán</small>
                                    <p class="mb-0 fw-semibold">{{ $order->phuong_thuc_thanh_toan ?? 'Không có' }}</p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-shipping-fast me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Trạng thái</small>
                                    <p class="mb-0">
                                        <span class="badge {{ $order->trang_thai == 'Đã giao' ? 'bg-success' : ($order->trang_thai == 'Đang xử lý' ? 'bg-warning text-dark' : 'bg-secondary') }} py-2 px-3 rounded-pill">
                                            {{ $order->trang_thai ?? 'Không có' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center mb-3">
                                <i class="fas fa-calendar-alt me-3 text-primary"></i>
                                <div>
                                    <small class="text-muted">Ngày tạo</small>
                                    <p class="mb-0 fw-semibold">{{ $order->created_at ? $order->created_at->format('d/m/Y H:i') : 'Không có' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning text-center">Bạn chưa có đơn hàng nào.</div>
    @endif
</div>

@include('clients.footer')
