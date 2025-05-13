<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'checkAvailability']);
    }

    public function index()
    {
        $bookings = Auth::user()->bookings()->with('room')->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all()->groupBy('room_type');
        return view('booking', ['title' => 'Booking', 'rooms' => $rooms]);
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login.form')->with('toast_error', 'Please log in to complete your booking.');
        }

        $validated = $request->validate([
            'checkIn' => 'required|date|after:today',
            'checkOut' => 'required|date|after:checkIn',
            'guests' => 'required|integer|min:1',
            'roomType' => 'required|in:standard,deluxe,suite',
        ]);

        $room = Room::where('room_type', $request->roomType)
            ->where('status', 'available')
            ->first();

        if (!$room || !$room->isAvailable($request->checkIn, $request->checkOut)) {
            return back()->with('toast_error', 'No available rooms for the selected type and dates.');
        }

        $days = (strtotime($request->checkOut) - strtotime($request->checkIn)) / (60 * 60 * 24);
        $totalAmount = $room->price * $days;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'checkin_date' => $request->checkIn,
            'checkout_date' => $request->checkOut,
            'number_of_guests' => $request->guests,
            'status' => 'pending',
            'total_amount' => $totalAmount,
        ]);

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Booking created successfully!');
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    public function checkAvailability(Request $request)
    {
        $validated = $request->validate([
            'checkIn' => 'required|date|after:today',
            'checkOut' => 'required|date|after:checkIn',
            'roomType' => 'required|in:standard,deluxe,suite',
        ]);

        $rooms = Room::where('room_type', $request->roomType)
            ->where('status', 'available')
            ->get()
            ->filter(function ($room) use ($request) {
                return $room->isAvailable($request->checkIn, $request->checkOut);
            });

        return response()->json(['rooms' => $rooms]);
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('update', $booking);
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('bookings.index')->with('toast_success', 'Booking cancelled.');
    }
}