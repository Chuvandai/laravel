@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quản lý sản phẩm</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Danh mục</th>
                            <th>Trạng thái danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                <img src="{{ asset($product->image) }}" alt="Product Image" 
                                    style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <span class="badge badge-{{ $product->category->status == 0 ? 'success' : 'danger' }}">
                                    {{ $product->category->status == 0 ? 'Hoạt động' : 'Tạm dừng' }}
                                </span>x
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit">Sửa</i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="fas fa-trash">Xóa</i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
