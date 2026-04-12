@extends('layouts.app')

@section('title', 'Đăng bài cẩm nang')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Đăng bài cẩm nang du lịch</h4>
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

                <form action="{{ route('guides.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <textarea name="summary" rows="3" class="form-control">{{ old('summary') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nội dung chi tiết</label>
                        <textarea name="content" rows="10" class="form-control" required>{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" name="cover_image" class="form-control" accept="image/*">
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" value="1" id="is_published" name="is_published" {{ old('is_published', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_published">
                            Hiển thị công khai ngay sau khi đăng
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-success" type="submit">Đăng bài</button>
                        <a href="{{ route('guides.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
