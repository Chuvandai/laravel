
@extends('admin.layouts.app')
@section('title', 'Chỉnh sửa biến thể')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa biến thể</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.variants.update', $variant->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" 
                                            {{ $variant->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
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
                            <label>Dung lượng</label>
                            <input type="text" 
                                   name="storage" 
                                   class="form-control @error('storage') is-invalid @enderror" 
                                   value="{{ old('storage', $variant->storage) }}">
                            @error('storage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Màu sắc</label>
                            <input type="text" 
                                   name="color" 
                                   class="form-control @error('color') is-invalid @enderror" 
                                   value="{{ old('color', $variant->color) }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá</label>
                            <input type="number" 
                                   name="price" 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $variant->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Số lượng tồn</label>
                            <input type="number" 
                                   name="stock" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', $variant->stock) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                    <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Quay lại
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection