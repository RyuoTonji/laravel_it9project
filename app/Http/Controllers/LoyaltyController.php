<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoyaltyProgram;
use App\Models\Discount;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class LoyaltyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loyalty = Auth::user()->loyaltyProgram;
        return view('loyalty.index', compact('loyalty'));
    }

    public function applyDiscount(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'code' => 'required|string',
        ]);

        $discount = Discount::where('code', $request->code)->first();

        if (!$discount || !$discount->isValid()) {
            return back()->with('toast_error', 'Invalid or expired discount code.');
        }

        $booking->discounts()->attach($discount->id);
        $discountAmount = $discount->discount_type === 'percentage'
            ? $booking->total_amount * ($discount->discount_value / 100)
            : $discount->discount_value;

        $booking->update(['total_amount' => $booking->total_amount - $discountAmount]);

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Discount applied.');
    }
}