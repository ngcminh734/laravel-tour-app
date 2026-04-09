@extends('layouts.app')

@section('content')

<div class="card shadow p-4" style="max-width:500px; margin:auto; border-radius:15px;">
    <h3 class="text-center mb-3">✏️ Sửa Tour</h3>

    <form method="POST" action="/update/{{ $tour->id }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

    <!-- các input ở đây -->

        {{-- Tên tour --}}
        <input class="form-control mb-3" name="name" value="{{ old('name', $tour->name) }}" required>

        {{-- Mô tả --}}
        <textarea class="form-control mb-3" name="description" required>{{ old('description', $tour->description) }}</textarea>

        {{-- Giá --}}
        <input class="form-control mb-3" name="price" value="{{ old('price', $tour->price) }}" type="number" required>

        {{-- Số chỗ --}}
        <input class="form-control mb-3" name="slots" value="{{ old('slots', $tour->slots) }}" type="number" required>

        {{-- Danh mục --}}
        <select class="form-control mb-3" name="category">
            <option value="">Chọn danh mục</option>
            <option value="Trong nước" {{ old('category', $tour->category) == 'Trong nước' ? 'selected' : '' }}>Trong nước</option>
            <option value="Nước ngoài" {{ old('category', $tour->category) == 'Nước ngoài' ? 'selected' : '' }}>Nước ngoài</option>
        </select>

        {{-- Ảnh --}}
        <div class="mb-3">
            <label class="form-label">Ảnh tour (để trống nếu không thay đổi)</label>

            {{-- preview ảnh hiện tại --}}
            @if($tour->image)
                <div class="mb-2 text-center">
                    <img src="{{ asset('storage/' . $tour->image) }}" 
                         style="width:100%; max-height:200px; object-fit:cover; border-radius:10px;">
                </div>
            @endif

            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        {{-- Hành trình --}}
        <textarea class="form-control mb-3" name="itinerary" rows="5" placeholder="Hành trình tour">{{ old('itinerary', $tour->itinerary) }}</textarea>

        <button class="btn btn-primary w-100">Cập nhật</button>
    </form>
</div>

@endsection