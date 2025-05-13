<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,paypal,cash',
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'payment_date' => now(),
            'status' => $request->payment_method === 'cash' ? 'pending' : 'completed',
        ]);

        if ($request->amount >= $booking->total_amount) {
            $booking->update(['status' => 'confirmed']);
        }

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Payment recorded successfully!');
    }
}