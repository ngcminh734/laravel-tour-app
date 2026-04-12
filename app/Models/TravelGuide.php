<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelGuide extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'summary',
        'content',
        'cover_image',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
