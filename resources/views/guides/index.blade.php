@extends('layouts.app')

@section('title', 'Cẩm nang du lịch')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="mb-1">Cẩm nang du lịch</h2>
        <p class="text-muted mb-0">Chia sẻ kinh nghiệm, lịch trình, mẹo và review điểm đến thực tế.</p>
    </div>
    @auth
        <a href="{{ route('guides.create') }}" class="btn btn-success">
            <i class="fas fa-pen"></i> Đăng bài mới
        </a>
    @endauth
</div>

<div class="row g-4">
    @forelse($guides as $guide)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm">
                @if($guide->cover_image)
                    <img src="{{ asset('storage/' . $guide->cover_image) }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $guide->title }}">
                @else
                    <img src="https://picsum.photos/700/420?random={{ $guide->id }}" class="card-img-top" style="height: 220px; object-fit: cover;" alt="{{ $guide->title }}">
                @endif

                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge {{ $guide->is_published ? 'bg-success' : 'bg-secondary' }}">
                            {{ $guide->is_published ? 'Đang hiển thị' : 'Đã thu hồi' }}
                        </span>
                        <small class="text-muted">{{ $guide->created_at->format('d/m/Y') }}</small>
                    </div>

                    <h5 class="card-title">{{ $guide->title }}</h5>
                    <p class="card-text text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit($guide->summary ?: $guide->content, 120) }}</p>
                    <p class="small mb-3">Tác giả: <strong>{{ $guide->user->name ?? 'Không rõ' }}</strong></p>

                    <div class="d-flex flex-wrap gap-2 mt-auto">
                        <a href="{{ route('guides.show', $guide->id) }}" class="btn btn-outline-primary btn-sm flex-grow-1">Xem chi tiết</a>

                        @auth
                            @if(Auth::user()->isAdmin() || Auth::id() === $guide->user_id)
                                <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-warning btn-sm flex-grow-1">Sửa</a>

                                @if($guide->is_published)
                                    <form action="{{ route('guides.retract', $guide->id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <button type="submit" class="btn btn-secondary btn-sm w-100" onclick="return confirm('Thu hồi bài viết này?')">Thu hồi</button>
                                    </form>
                                @else
                                    <form action="{{ route('guides.publish', $guide->id) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm w-100">Đăng lại</button>
                                    </form>
                                @endif

                                <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100" onclick="return confirm('Xóa bài viết này?')">Xóa</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Chưa có bài cẩm nang nào. Hãy là người đầu tiên chia sẻ kinh nghiệm của bạn.</div>
        </div>
    @endforelse
</div>
@endsection
