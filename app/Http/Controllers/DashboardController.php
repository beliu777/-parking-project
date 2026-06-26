<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['spot', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $activeBookings = $bookings->whereIn('status', ['paid', 'waiting_payment'])->count();
        $paidBookings = $bookings->where('status', 'paid')->count();

        return view('dashboard', compact('bookings', 'activeBookings', 'paidBookings'));
    }
}