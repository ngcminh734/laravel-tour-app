@extends('layouts.app')

@section('content')

<div class="card shadow p-4" style="max-width:500px; margin:auto; border-radius:15px;">
    <h3 class="text-center mb-3">➕ Thêm Tour</h3>

    <form method="POST" action="/store" enctype="multipart/form-data">
        @csrf

        <input class="form-control mb-3" name="name" placeholder="Tên tour" required>

        <textarea class="form-control mb-3" name="description" placeholder="Mô tả" required></textarea>

        <input class="form-control mb-3" name="price" placeholder="Giá" type="number" required>

        <input class="form-control mb-3" name="slots" placeholder="Số chỗ" type="number" required>

        <select class="form-control mb-3" name="category">
            <option value="">Chọn danh mục</option>
            <option value="Trong nước">Trong nước</option>
            <option value="Nước ngoài">Nước ngoài</option>
        </select>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh tour</label>
            <input type="file" class="form-control" name="image" accept="image/*">
        </div>

        <textarea class="form-control mb-3" name="itinerary" placeholder="Hành trình tour (mô tả chi tiết)" rows="5"></textarea>

        <button class="btn btn-success w-100">Thêm tour</button>
    </form>
</div>

@endsection