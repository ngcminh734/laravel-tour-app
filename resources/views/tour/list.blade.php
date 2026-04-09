@extends('layouts.app')

@section('title', 'Tour Trong Nước')

@section('content')
@auth
    @if(Auth::user()->isAdmin())
        <div class="d-flex justify-content-end mb-3">
            <a href="/create" class="btn btn-success">
                ➕ Thêm tour
            </a>
        </div>
    @endif
@endauth
<div class="list-filter d-flex flex-column flex-lg-row gap-3 align-items-start align-items-lg-center mb-4">
    <form method="GET" action="/" class="d-flex flex-wrap gap-3 align-items-center w-100">
        <div class="flex-grow-1">
            <input type="text" name="search" class="form-control" placeholder="🔍 Tìm kiếm tour..." value="{{ request('search') }}">
        </div>
        <div>
            <select name="category" class="form-select">
                <option value="">🏷️ Tất cả danh mục</option>
                <option value="Trong nước" {{ request('category') == 'Trong nước' ? 'selected' : '' }}>Trong nước</option>
                <option value="Nước ngoài" {{ request('category') == 'Nước ngoài' ? 'selected' : '' }}>Nước ngoài</option>
            </select>
        </div>
        <div>
            <button class="btn btn-primary px-4"> <i class="fas fa-search me-2"></i> Tìm tour</button>
        </div>
    </form>
</div>

<div class="row">
@foreach($tours as $tour)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="tour-card h-100">
            @if($tour->image)
                <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->name }}">
            @else
                <img src="https://picsum.photos/600/400?random={{ $tour->id }}" class="card-img-top" alt="{{ $tour->name }}">
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title"><i class="fas fa-map-marker-alt text-success me-2"></i>{{ $tour->name }}</h5>
                <p class="card-text flex-grow-1">{{ Str::limit($tour->description, 110) }}</p>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-success"><i class="fas fa-tag me-1"></i>{{ $tour->category ?: 'Chưa phân loại' }}</span>
                    <span class="badge bg-info text-dark"><i class="fas fa-users me-1"></i>{{ $tour->slots }} chỗ</span>
                </div>
                <div class="mb-3">
                    <span class="price-tag">Giá: {{ number_format($tour->price, 0, ',', '.') }} đ</span>
                </div>
                <div class="mt-auto d-flex flex-wrap gap-2">
                    <a href="/show/{{ $tour->id }}" class="btn btn-outline-success btn-sm flex-grow-1"><i class="fas fa-eye me-1"></i> Chi tiết</a>
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="/edit/{{ $tour->id }}" class="btn btn-warning btn-sm flex-grow-1"><i class="fas fa-edit me-1"></i> Sửa</a>
                            <a href="/delete/{{ $tour->id }}" onclick="return confirm('Xóa tour này?')" class="btn btn-danger btn-sm flex-grow-1"><i class="fas fa-trash me-1"></i> Xóa</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
