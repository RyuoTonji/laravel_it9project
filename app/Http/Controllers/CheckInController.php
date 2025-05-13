<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\CheckIn;
use App\Models\LoyaltyProgram;
use App\Models\Room;

class CheckInController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Manager|Admin|Cashier');
    }

    public function store(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status !== 'confirmed') {
            return back()->with('toast_error', 'Booking must be confirmed before check-in.');
        }

        CheckIn::create([
            'booking_id' => $booking->id,
            'check_in_time' => now(),
        ]);

        $booking->update(['status' => 'checked_in']);
        $booking->room->update(['status' => 'occupied']);

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Guest checked in.');
    }

    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        if ($booking->status !== 'checked_in') {
            return back()->with('toast_error', 'Booking must be checked in before check-out.');
        }

        $checkIn = $booking->checkIn;
        $checkIn->update(['check_out_time' => now()]);

        $booking->update(['status' => 'checked_out']);
        $booking->room->update(['status' => 'available']);

        // Update loyalty points
        $user = $booking->user;
        $loyalty = $user->loyaltyProgram ?? LoyaltyProgram::create(['user_id' => $user->id]);
        $points = floor($booking->total_amount / 1000); // 1 point per 1000 PHP
        $loyalty->increment('points', $points);
        $user->loyaltyProgram->update([
            'tier' => $loyalty->points >= 100 ? 'gold' : ($loyalty->points >= 50 ? 'silver' : 'basic'),
        ]);

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Guest checked out.');
    }
}