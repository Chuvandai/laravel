@extends('admin.layouts.app')
@section('title', 'Thêm biến thể mới')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thêm biến thể mới</h6>
        </div>
        <div class="card-body">
            @if($products->isEmpty())
                <div class="alert alert-warning">
                    Không có sản phẩm nào để thêm biến thể. Vui lòng thêm sản phẩm trước.
                </div>
            @else
                <form action="{{ route('admin.variants.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sản phẩm <span class="text-danger">*</span></label>
                                <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn sản phẩm --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - {{ number_format($product->price) }} VNĐ
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dung lượng <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="storage" 
                                       class="form-control @error('storage') is-invalid @enderror" 
                                       value="{{ old('storage') }}"
                                       placeholder="VD: 128GB"
                                       required>
                                @error('storage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Màu sắc <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="color" 
                                       class="form-control @error('color') is-invalid @enderror" 
                                       value="{{ old('color') }}"
                                       placeholder="VD: Đen"
                                       required>
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Giá <span class="text-danger">*</span></label>
                                <input type="number" 
                                       name="price" 
                                       class="form-control @error('price') is-invalid @enderror" 
                                       value="{{ old('price') }}"
                                       min="0"
                                       required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số lượng tồn <span class="text-danger">*</span></label>
                                <input type="number" 
                                       name="stock" 
                                       class="form-control @error('stock') is-invalid @enderror" 
                                       value="{{ old('stock', 0) }}"
                                       min="0"
                                       required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                        <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection