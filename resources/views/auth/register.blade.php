@extends('layouts.app')

@section('title', 'Đăng ký')

@section('hero')
<section class="page-hero-inner" style="background: linear-gradient(180deg, rgba(31, 125, 52, 0.95), rgba(31, 125, 52, 0.75)), url('https://images.unsplash.com/photo-1497493292307-31c376b6e479?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;">
    <div class="container text-white">
        <div class="page-breadcrumb">Trang chủ <i class="fas fa-angle-right mx-2"></i> Đăng ký</div>
        <h1 class="hero-title">Tạo tài khoản mới</h1>
        <p class="hero-subtitle">Tham gia cộng đồng du lịch, đặt tour nhanh chóng và quản lý hành trình dễ dàng.</p>
    </div>
</section>
@endsection

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-lg-6">
        <div class="card register-card">
            <div class="card-header text-center">
                <h4><i class="fas fa-user-plus me-2"></i>Đăng ký tài khoản</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2"><i class="fas fa-user-plus me-2"></i> Đăng ký</button>
                </form>
            </div>
            <div class="card-footer register-footer text-center py-4">
                <p class="mb-0">Đã có tài khoản? <a href="{{ route('login') }}" class="text-success fw-semibold">Đăng nhập</a></p>
            </div>
        </div>
    </div>
</div>
@endsection