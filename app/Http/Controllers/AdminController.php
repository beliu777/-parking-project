<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use App\Models\ParkingSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403);
        }

        $users = User::latest()->get();

        $bookings = Booking::with([
            'user',
            'spot.parkingLot'
        ])->latest()->get();

        return view('admin.index', compact(
            'users',
            'bookings'
        ));
    }

    public function editUser(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'is_admin' => 'nullable',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $request->has('is_admin'),
        ]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Пользователь обновлен');
    }

    public function deleteUser(User $user)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        if ($user->id === Auth::id()) {
            return back()->with('success', 'Нельзя удалить самого себя');
        }

        $user->delete();

        return back()->with('success', 'Пользователь удален');
    }

    public function freeSpot(ParkingSpot $spot)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $spot->update([
            'status' => 'free',
            'is_available' => true,
        ]);

        return back()->with('success', 'Место освобождено');
    }

    public function changeSpotStatus(ParkingSpot $spot)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        return view('admin.spot-status', compact('spot'));
    }

    public function updateSpotStatus(Request $request, ParkingSpot $spot)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:free,busy,inactive',
        ]);

        $spot->update([
            'status' => $request->status,
            'is_available' => $request->status === 'free',
        ]);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Статус обновлен');
    }

    public function cancelAndRefund(Booking $booking)
    {
        if (!Auth::user()->is_admin) {
            abort(403);
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        if ($booking->spot) {
            $booking->spot->update([
                'status' => 'free',
                'is_available' => true,
            ]);
        }

        return back()->with('success', 'Бронирование отменено');
    }
}