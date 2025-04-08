@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Danh sách đơn hàng</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Mã đơn hàng</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Phương thức thanh toán</th>
                                <th scope="col">Ngày đặt</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->ho_va_ten }}</td>
                                    <td>{{ $order->dia_chi }}</td>
                                    <td>{{ number_format($order->tong_tien) }} VND</td>
                                    <td>
                                        <span class="badge badge-{{ $order->getStatusColor() }}">
                                            {{ $order->getStatusText() }}
                                        </span>
                                    </td>
                                    <td>{{ $order->phuong_thuc_thanh_toan }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.ordersadmin.show', $order->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge-pending {
            background-color: #ffc107;
            color: #000;
        }
        .badge-processing {
            background-color: #17a2b8;
            color: #fff;
        }
        .badge-shipped {
            background-color: #007bff;
            color: #fff;
        }
        .badge-delivered {
            background-color: #28a745;
            color: #fff;
        }
        .badge-cancelled {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
@endsection
