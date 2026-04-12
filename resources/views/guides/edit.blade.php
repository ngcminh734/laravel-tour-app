@extends('layouts.app')

@section('title', 'Chỉnh sửa bài cẩm nang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-warning">
                <h4 class="mb-0">Chỉnh sửa bài cẩm nang</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('guides.update', $guide->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $guide->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea name="summary" rows="3" class="form-control">{{ old('summary', $guide->summary) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung chi tiết</label>
                        <textarea name="content" rows="10" class="form-control" required>{{ old('content', $guide->content) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh đại diện mới (tùy chọn)</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                    </div>

                    @if($guide->cover_image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $guide->cover_image) }}" alt="{{ $guide->title }}" class="img-fluid rounded" style="max-height: 220px; object-fit: cover;">
                        </div>
                    @endif

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="is_published" name="is_published" {{ old('is_published', $guide->is_published) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Hiển thị công khai
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-warning" type="submit">Lưu thay đổi</button>
                        <a href="{{ route('guides.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
