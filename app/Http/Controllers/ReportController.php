<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Manager|Admin');
    }

    public function reservations(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());
        $bookings = Booking::whereBetween('checkin_date', [$startDate, $endDate])
            ->with('user', 'room')
            ->get();

        return view('reports.reservations', compact('bookings', 'startDate', 'endDate'));
    }

    public function revenue(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());
        $payments = Payment::whereBetween('payment_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->with('booking')
            ->get();

        $totalRevenue = $payments->sum('amount');
        return view('reports.revenue', compact('payments', 'totalRevenue', 'startDate', 'endDate'));
    }

    public function exportReservations(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth());
        $endDate = $request->input('end_date', now());
        $bookings = Booking::whereBetween('checkin_date', [$startDate, $endDate])
            ->with('user', 'room')
            ->get();

        $pdf = Pdf::loadView('reports.reservations_pdf', compact('bookings', 'startDate', 'endDate'));
        return $pdf->download('reservations_report.pdf');
    }
}