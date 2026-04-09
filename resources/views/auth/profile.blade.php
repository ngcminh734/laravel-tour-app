@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-info text-white text-center">
                    <h4><i class="fas fa-user"></i> Thông tin tài khoản</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <i class="fas fa-user-circle fa-5x text-primary mb-3"></i>
                        </div>
                        <div class="col-md-8">
                            <h5>Họ tên: {{ Auth::user()->name }}</h5>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Vai trò:</strong> 
                                <span class="badge {{ Auth::user()->isAdmin() ? 'bg-danger' : 'bg-secondary' }}">
                                    {{ Auth::user()->role }}
                                </span>
                            </p>
                            <p><strong>Ngày tạo:</strong> {{ Auth::user()->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Cập nhật lần cuối:</strong> {{ Auth::user()->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="/" class="btn btn-secondary"><i class="fas fa-home"></i> Về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection