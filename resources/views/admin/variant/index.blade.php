@extends('admin.layouts.app')
@section('title', 'Quản lý biến thể')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách biến thể</h6>
            <a href="{{ route('admin.variants.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm biến thể
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Dung lượng</th>
                            <th>Màu sắc</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($variants as $variant)
                        <tr>
                            <td>{{ $variant->id }}</td>
                            <td>{{ $variant->product->name }}</td>
                            <td>{{ $variant->storage }}</td>
                            <td>{{ $variant->color }}</td>
                            <td>{{ number_format($variant->price) }} VNĐ</td>
                            <td>{{ $variant->stock }}</td>
                            <td>
                                <a href="{{ route('admin.variants.edit', $variant->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.variants.destroy', $variant->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Bạn có chắc muốn xóa?')">
                                        <i class="fas fa-trash"></i>
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

<style>
.color-preview {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 10px;
    border: 1px solid #ddd;
}
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection