<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tour Du Lịch')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark main-navbar sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="brand-icon"><i class="fas fa-leaf"></i></span>
                <div>
                    <div class="brand-name">Vietland</div>
                    <div class="brand-tag">Travel</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request('category') == 'Nước ngoài' ? 'active' : '' }}"
                          href="/?category=Nước ngoài">
                          Tour quốc tế
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request('category') == 'Trong nước' ? 'active' : '' }}"
                           href="/?category=Trong nước">
                           Tour trong nước
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="/">Lưu ý</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Điểm đến</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Tin tức</a></li>
                    <li class="nav-item"><a class="nav-link" href="/">Thủ tục xin visa</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('guides.index') }}">Cẩm nang du lịch</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-success text-white px-4 ms-lg-3" href="/">Đặt tour</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('my-bookings') }}">Đơn của tôi</a></li>
                        @if(Auth::user()->isAdmin())
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Admin</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-flex m-0">
                                @csrf
                                <button type="submit" class="btn btn-danger ms-lg-3 px-4">Đăng xuất</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link btn btn-primary text-white px-4 ms-lg-3" href="{{ route('login') }}">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link btn btn-success text-white px-4 ms-lg-3" href="{{ route('register') }}">Đăng ký</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

@yield('hero')

<main class="main-content py-5">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger shadow-sm">{{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</main>

<footer class="site-footer py-4">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 text-white">
        <div>
            <h5 class="mb-2">Vietland Travel</h5>
            <p class="mb-0">Giải pháp tour du lịch trong nước và quốc tế chuyên nghiệp.</p>
        </div>
        <div class="text-muted small">&copy; 2026 Vietland Travel. Bản quyền thuộc về công ty TNHH VietlandHoliday.</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
