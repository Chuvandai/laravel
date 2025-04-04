@extends('admin.layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead class="table-info">
                <tr>
                    <th scope="col">stt</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Phương thức thanh toán</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index=>  $order)
                <tr>
                    <td scope="row">{{$index+1}}</td>
                    <td scope="row">{{$order->ho_va_ten}}</td>
                    <td>{{$order->dia_chi}}</td>
                    <td>{{$order->trang_thai}}</td>
                    <td>{{$order->phuong_thuc_thanh_toan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
