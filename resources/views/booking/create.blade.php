@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-calendar-check"></i> Đặt tour: {{ $tour->name }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('book.store', $tour->id) }}">
                        @csrf

                        <div class="mb-3">
                            <label for="number_of_people" class="form-label">Số người</label>
                            <input type="number" class="form-control @error('number_of_people') is-invalid @enderror" id="number_of_people" name="number_of_people" value="{{ old('number_of_people') }}" min="1" required>
                            @error('number_of_people')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Ngày khởi hành</label>
                            <input type="date" class="form-control @error('booking_date') is-invalid @enderror" id="booking_date" name="booking_date" value="{{ old('booking_date') }}" required>
                            @error('booking_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <p><strong>Giá tour:</strong> {{ number_format($tour->price) }} VNĐ/người</p>
                            <p><strong>Số chỗ còn:</strong> {{ $tour->slots }}</p>
                        </div>

                        <button type="submit" class="btn btn-success w-100"><i class="fas fa-check"></i> Đặt tour</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="/show/{{ $tour->id }}" class="btn btn-secondary">Quay lại chi tiết tour</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection