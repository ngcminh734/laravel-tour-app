@extends('layouts.app')

@section('content')

<div class="card shadow p-4" style="max-width:500px; margin:auto; border-radius:15px;">
    <h3 class="text-center mb-3">✏️ Sửa Tour</h3>

    <form method="POST" action="/update/{{ $tour->id }}" enctype="multipart/form-data">
        @csrf

        <input class="form-control mb-3" name="name" value="{{ $tour->name }}" required>

        <textarea class="form-control mb-3" name="description" required>{{ $tour->description }}</textarea>

        <input class="form-control mb-3" name="price" value="{{ $tour->price }}" type="number" required>

        <input class="form-control mb-3" name="slots" value="{{ $tour->slots }}" type="number" required>

        <select class="form-control mb-3" name="category">
            <option value="">Chọn danh mục</option>
            <option value="Trong nước" {{ $tour->category == 'Trong nước' ? 'selected' : '' }}>Trong nước</option>
            <option value="Nước ngoài" {{ $tour->category == 'Nước ngoài' ? 'selected' : '' }}>Nước ngoài</option>
        </select>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh tour (để trống nếu không thay đổi)</label>
            <input type="file" class="form-control" name="image" accept="image/*">
            @if($tour->image)
                <small class="form-text text-muted">Ảnh hiện tại: <img src="{{ asset('storage/' . $tour->image) }}" width="100" alt="Current image"></small>
            @endif
        </div>

        <textarea class="form-control mb-3" name="itinerary" placeholder="Hành trình tour (mô tả chi tiết)" rows="5">{{ $tour->itinerary }}</textarea>

        <button class="btn btn-primary w-100">Cập nhật</button>
    </form>
</div>

@endsection