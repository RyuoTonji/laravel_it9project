<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id', 'room_id', 'check_in_date', 'check_out_date',
        'number_of_guests', 'status', 'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function checkIn()
    {
        return $this->hasOne(CheckIn::class);
    }

    public function roomServices()
    {
        return $this->hasMany(RoomService::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(Discount::class, 'booking_discounts');
    }
}
