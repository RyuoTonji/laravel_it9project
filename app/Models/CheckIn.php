<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    protected $fillable = ['booking_id', 'check_in_time', 'check_out_time'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}