@extends('layouts.app')

@section('content')

<div class="card shadow p-4" style="max-width:500px; margin:auto; border-radius:15px;">
    <h3 class="text-center mb-3">➕ Thêm Tour</h3>

    <form method="POST" action="/store" enctype="multipart/form-data">
        @csrf

        {{-- Tên tour --}}
        <input class="form-control mb-3" name="name" placeholder="Tên tour" value="{{ old('name') }}" required>

        {{-- Mô tả --}}
        <textarea class="form-control mb-3" name="description" placeholder="Mô tả" required>{{ old('description') }}</textarea>

        {{-- Giá --}}
        <input class="form-control mb-3" name="price" placeholder="Giá" type="number" value="{{ old('price') }}" required>

        {{-- Số chỗ --}}
        <input class="form-control mb-3" name="slots" placeholder="Số chỗ" type="number" value="{{ old('slots') }}" required>

        {{-- Danh mục --}}
        <select class="form-control mb-3" name="category">
            <option value="">Chọn danh mục</option>
            <option value="Trong nước" {{ old('category') == 'Trong nước' ? 'selected' : '' }}>Trong nước</option>
            <option value="Nước ngoài" {{ old('category') == 'Nước ngoài' ? 'selected' : '' }}>Nước ngoài</option>
        </select>

        {{-- Ảnh --}}
        <div class="mb-3">
            <label class="form-label">Ảnh tour</label>
            <input type="file" class="form-control" name="image" accept="image/*" required>
        </div>

        {{-- Hành trình --}}
        <textarea class="form-control mb-3" name="itinerary" placeholder="Hành trình tour" rows="5">{{ old('itinerary') }}</textarea>

        <button class="btn btn-success w-100">Thêm tour</button>
    </form>
</div>

@endsection