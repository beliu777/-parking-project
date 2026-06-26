<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\ParkingLot;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function createForLot(ParkingLot $lot)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Сначала войдите в аккаунт.',
            ]);
        }

        $freeCount = ParkingSpot::where('parking_lot_id', $lot->id)
            ->where('status', 'free')
            ->count();

        return view('booking.create', compact('lot', 'freeCount'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->validate([
            'parking_lot_id' => 'required|exists:parking_lots,id',
            'phone' => 'required|string|max:30',
            'car_number' => 'required|string|max:20',
            'duration_minutes' => 'required|in:15,30,45,60',
        ]);

        $spot = ParkingSpot::where('parking_lot_id', $data['parking_lot_id'])
            ->where('status', 'free')
            ->orderBy('id')
            ->first();

        if (!$spot) {
            return back()->withErrors([
                'parking' => 'На этой парковке сейчас нет свободных мест.',
            ]);
        }

        $duration = (int) $data['duration_minutes'];
        $total = round(($spot->price_per_hour / 60) * $duration, 2);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'parking_spot_id' => $spot->id,
            'name' => Auth::user()->name,
            'phone' => $data['phone'],
            'car_number' => mb_strtoupper($data['car_number']),
            'duration_minutes' => $duration,
            'start_time' => now(),
            'end_time' => now()->addMinutes($duration),
            'total_price' => $total,
            'status' => 'waiting_payment',
        ]);

        $booking->update([
            'qr_code' => 'LOT-' . $spot->parking_lot_id . '-BOOK-' . $booking->id . '-' . Str::upper(Str::random(10)),
        ]);

        return redirect()->route('payment.show', $booking);
    }
}