<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['code', 'description', 'discount_type', 'discount_value', 'valid_from', 'valid_until'];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_discounts');
    }

    public function isValid()
    {
        $today = now()->toDateString();
        return $this->valid_from <= $today && $this->valid_until >= $today;
    }
}