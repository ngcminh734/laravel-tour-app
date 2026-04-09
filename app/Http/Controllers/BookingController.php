<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;

class BookingController extends Controller
{
    public function create($tourId)
    {
        $tour = Tour::findOrFail($tourId);
        return view('booking.create', compact('tour'));
    }

    public function store(Request $request, $tourId)
    {
        $request->validate([
            'number_of_people' => 'required|integer|min:1',
            'booking_date' => 'required|date|after:today',
        ]);

        $tour = Tour::findOrFail($tourId);

        Booking::create([
            'user_id' => auth()->id(),
            'tour_id' => $tourId,
            'number_of_people' => $request->number_of_people,
            'booking_date' => $request->booking_date,
        ]);

        return redirect('/')->with('success', 'Đặt tour thành công!');
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings()->with('tour')->get();
        return view('booking.my-bookings', compact('bookings'));
    }
}
