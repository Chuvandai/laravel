@include('clients.header')

<div class="container py-5">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('images/avatar.png') }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 class="mt-3">{{ Auth::user()->name }}</h5>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile.index') }}">
                                <i class="fas fa-user"></i> Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('orders.index') }}">
                                <i class="fas fa-shopping-bag"></i> Đơn hàng của tôi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">
                                <i class="fas fa-edit"></i> Chỉnh sửa thông tin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.password') }}">
                                <i class="fas fa-key"></i> Đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->phone ?? 'Chưa cập nhật' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->address ?? 'Chưa cập nhật' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Đơn hàng gần đây</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã đơn hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($order->tong_tien) }} VND</td>
                                        <td>
                                            <span class="badge bg-{{ $order->getStatusColor() }}">
                                                {{ $order->getStatusText() }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Chưa có đơn hàng nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-link {
        color: #333;
        padding: 10px 15px;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .nav-link:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }

    .nav-link.active {
        background-color: #0d6efd;
        color: white;
    }

    .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .card {
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border: none;
        border-radius: 10px;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
    }

    .form-control:read-only {
        background-color: #f8f9fa;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 5px;
    }

    .bg-Chờ xử lý { background-color: #ffc107; color: #000; }
    .bg-Đã xác nhận { background-color: #17a2b8; color: #fff; }
    .bg-Đang giao hàng { background-color: #007bff; color: #fff; }
    .bg-Đã giao { background-color: #28a745; color: #fff; }
    .bg-Hủy { background-color: #dc3545; color: #fff; }
</style>

@include('clients.footer') 