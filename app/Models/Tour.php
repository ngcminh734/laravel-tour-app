<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['name','description','price','slots','category','image','itinerary'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}