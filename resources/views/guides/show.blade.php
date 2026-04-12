@extends('layouts.app')

@section('title', $guide->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <article class="card shadow-sm">
            @if($guide->cover_image)
                <img src="{{ asset('storage/' . $guide->cover_image) }}" alt="{{ $guide->title }}" class="card-img-top" style="max-height: 460px; object-fit: cover;">
            @endif

            <div class="card-body p-4 p-lg-5">
                <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                    <span class="badge {{ $guide->is_published ? 'bg-success' : 'bg-secondary' }}">
                        {{ $guide->is_published ? 'Đang hiển thị' : 'Đã thu hồi' }}
                    </span>
                    <span class="text-muted">Tác giả: <strong>{{ $guide->user->name ?? 'Không rõ' }}</strong></span>
                    <span class="text-muted">| {{ $guide->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <h1 class="mb-3">{{ $guide->title }}</h1>

                @if($guide->summary)
                    <p class="lead text-muted">{{ $guide->summary }}</p>
                @endif

                <hr>

                <div style="white-space: pre-line; line-height: 1.8;">
                    {{ $guide->content }}
                </div>
            </div>
        </article>

        <div class="mt-4 d-flex flex-wrap gap-2">
            <a href="{{ route('guides.index') }}" class="btn btn-secondary">Quay lại cẩm nang</a>
            @auth
                @if(Auth::user()->isAdmin() || Auth::id() === $guide->user_id)
                    <a href="{{ route('guides.edit', $guide->id) }}" class="btn btn-warning">Sửa bài viết</a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
