@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa Banner</h1>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Tiêu đề</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $banner->title) }}" >
                </div>

                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh hiện tại</label>
                    <div>
                        <img src="{{ asset($banner->image) }}" alt="Current Banner" style="max-width: 200px;">
                    </div>
                    <label for="image" class="mt-2">Chọn hình ảnh mới (nếu muốn thay đổi)</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" 
                           id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <select class="form-control" id="status" name="status" >
                        <option value="0" {{ old('status', $banner->status) == '0' ? 'selected' : '' }}>Hiển thị</option>
                        <option value="1" {{ old('status', $banner->status) == '1' ? 'selected' : '' }}>Ẩn</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
