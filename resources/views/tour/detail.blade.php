@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-8">
            <h1 class="display-4 text-primary mb-4">{{ $tour->name }}</h1>
            
            @if($tour->image)
                <img src="{{ asset('storage/' . $tour->image) }}" class="img-fluid rounded shadow mb-4" alt="{{ $tour->name }}">
            @else
                <img src="https://picsum.photos/800/400?random={{ $tour->id }}" class="img-fluid rounded shadow mb-4" alt="{{ $tour->name }}">
            @endif
            
            <p class="lead">{{ $tour->description }}</p>
            
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="card text-center p-3">
                        <h5>💰 Giá</h5>
                        <p class="h4 text-success">{{ number_format($tour->price) }} VNĐ</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-center p-3">
                        <h5>👥 Số chỗ</h5>
                        <p class="h4 text-info">{{ $tour->slots }}</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card text-center p-3">
                        <h5>🏷️ Danh mục</h5>
                        <p class="h4 text-warning">{{ $tour->category ?: 'Chưa phân loại' }}</p>
                    </div>
                </div>
            </div>
            
            @if($tour->itinerary)
                <h3 class="mb-3">🗺️ Hành trình tour</h3>
                <div class="bg-light p-4 rounded">
                    {!! nl2br(e($tour->itinerary)) !!}
                </div>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Đặt tour ngay!</h5>
                    <p class="card-text">Liên hệ chúng tôi để đặt tour này.</p>
                    @auth
                        <a href="{{ route('book.create', $tour->id) }}" class="btn btn-success w-100 mb-2"><i class="fas fa-calendar-check"></i> Đặt tour</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success w-100 mb-2"><i class="fas fa-sign-in-alt"></i> Đăng nhập để đặt</a>
                    @endauth
                    <a href="#" class="btn btn-primary w-100">📞 Liên hệ đặt tour</a>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="/" class="btn btn-secondary w-100">← Quay lại danh sách</a>
            </div>
        </div>
    </div>
</div>

@endsection