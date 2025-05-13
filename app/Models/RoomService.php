<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomService extends Model
{
    protected $fillable = ['booking_id', 'service_type', 'description', 'cost', 'status'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}