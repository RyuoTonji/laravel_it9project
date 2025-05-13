<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyProgram extends Model
{
    protected $fillable = ['user_id', 'points', 'tier'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}