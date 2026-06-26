<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function show(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load('spot.parkingLot');

        return view('payment.show', compact('booking'));
    }

    public function pay(Request $request, Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'paid') {
            return redirect()->route('payment.success', $booking);
        }

        $request->validate([
            'card_number' => 'required|string|min:16|max:25',
            'card_date' => 'required|string|max:10',
            'card_cvv' => 'required|string|min:3|max:4',
        ]);

        Payment::create([
            'booking_id' => $booking->id,
            'amount' => $booking->total_price,
            'method' => 'fake_card',
            'status' => 'paid',
        ]);

        $booking->update([
            'status' => 'paid',
        ]);

        $booking->spot->update([
            'status' => 'busy',
            'is_available' => false,
        ]);

        return redirect()->route('payment.success', $booking);
    }

    public function success(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['spot.parkingLot', 'payment']);

        return view('payment.success', compact('booking'));
    }

    public function mobile(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load('spot.parkingLot');

        return view('payment.mobile', compact('booking'));
    }

    public function receipt(Booking $booking)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->load(['spot.parkingLot', 'payment', 'user']);

        return view('booking.receipt', compact('booking'));
    }
}