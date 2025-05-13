<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RoomService;

class RoomServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('room_services.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);

        $validated = $request->validate([
            'service_type' => 'required|in:food,laundry,cleaning,other',
            'description' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
        ]);

        RoomService::create([
            'booking_id' => $booking->id,
            'service_type' => $request->service_type,
            'description' => $request->description,
            'cost' => $request->cost,
            'status' => 'requested',
        ]);

        return redirect()->route('bookings.show', $booking)->with('toast_success', 'Service requested.');
    }

    public function update(Request $request, RoomService $roomService)
    {
        $this->authorize('update', $roomService->booking);
        $validated = $request->validate([
            'status' => 'required|in:requested,in_progress,completed,cancelled',
        ]);

        $roomService->update(['status' => $request->status]);
        return redirect()->route('bookings.show', $roomService->booking)->with('toast_success', 'Service status updated.');
    }
}