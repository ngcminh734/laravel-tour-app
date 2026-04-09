@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center text-white"><i class="fas fa-list"></i> Đơn đặt tour của tôi</h2>

    @if($bookings->count() > 0)
        <div class="row">
            @foreach($bookings as $booking)
                <div class="col-md-6 mb-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->tour->name }}</h5>
                            <p class="card-text">
                                <strong>Số người:</strong> {{ $booking->number_of_people }}<br>
                                <strong>Ngày đặt:</strong> {{ $booking->booking_date->format('d/m/Y') }}<br>
                                <strong>Trạng thái:</strong> 
                                <span class="badge {{ $booking->status === 'confirmed' ? 'bg-success' : ($booking->status === 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $booking->status }}
                                </span><br>
                                <strong>Tổng tiền:</strong> {{ number_format($booking->tour->price * $booking->number_of_people) }} VNĐ
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <p class="text-white">Bạn chưa đặt tour nào.</p>
            <a href="/" class="btn btn-primary">Xem tours</a>
        </div>
    @endif
</div>
@endsection