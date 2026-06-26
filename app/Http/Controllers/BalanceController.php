<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BalanceController extends Controller
{
    public function topUp(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:100|max:100000',
        ]);

        $user = Auth::user();
        $user->balance += $data['amount'];
        $user->save();

        return back()->with('success', 'Баланс успешно пополнен на ' . $data['amount'] . ' ₽');
    }
}