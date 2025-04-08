@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Chi tiết đơn hàng #{{ $order->id }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.ordersadmin.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin đơn hàng</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Mã đơn hàng:</th>
                                        <td>#{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày đặt:</th>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái:</th>
                                        <td>
                                            <form action="{{ route('admin.ordersadmin.update-status', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                                    @if($order->trang_thai == 'Chờ xử lý')
                                                        <option value="Chờ xử lý" selected>Chờ xử lý</option>
                                                        <option value="Đã xác nhận">Đã xác nhận</option>
                                                        <option value="Hủy">Hủy</option>
                                                    @elseif($order->trang_thai == 'Đã xác nhận')
                                                        <option value="Đã xác nhận" selected>Đã xác nhận</option>
                                                        <option value="Đang giao hàng">Đang giao hàng</option>
                                                        <option value="Hủy">Hủy</option>
                                                    @elseif($order->trang_thai == 'Đang giao hàng')
                                                        <option value="Đang giao hàng" selected>Đang giao hàng</option>
                                                        <option value="Đã giao">Đã giao</option>
                                                    @elseif($order->trang_thai == 'Đã giao')
                                                        <option value="Đã giao" selected>Đã giao</option>
                                                    @elseif($order->trang_thai == 'Hủy')
                                                        <option value="Hủy" selected>Hủy</option>
                                                    @endif
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phương thức thanh toán:</th>
                                        <td>{{ $order->phuong_thuc_thanh_toan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tổng tiền:</th>
                                        <td>{{ number_format($order->tong_tien) }} VND</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin khách hàng</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Họ và tên:</th>
                                        <td>{{ $order->ho_va_ten }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Số điện thoại:</th>
                                        <td>{{ $order->so_dien_thoai }}</td>
                                    </tr>
                                    <tr>
                                        <th>Địa chỉ:</th>
                                        <td>{{ $order->dia_chi }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        <h4 class="card-title">Sản phẩm đã đặt</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Sản phẩm</th>
                                        <th>Dung lượng</th>
                                        <th>Màu sắc</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $index => $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset($detail->product->hinh_anh) }}" 
                                                         alt="{{ $detail->product->ten_san_pham }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                    <div class="ml-2">
                                                        {{ $detail->product->ten_san_pham }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $detail->dung_luong }}</td>
                                            <td>{{ $detail->mau_sac }}</td>
                                            <td>{{ number_format($detail->gia) }} VND</td>
                                            <td>{{ $detail->so_luong }}</td>
                                            <td>{{ number_format($detail->gia * $detail->so_luong) }} VND</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Tổng tiền:</strong></td>
                                        <td><strong>{{ number_format($order->tong_tien) }} VND</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection