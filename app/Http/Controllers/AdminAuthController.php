<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($data)) {
            return back()->withErrors([
                'email' => 'Неверная почта или пароль.',
            ]);
        }

        if (!Auth::user()->is_admin) {
            Auth::logout();

            return back()->withErrors([
                'email' => 'У вас нет прав суперпользователя.',
            ]);
        }

        session(['admin_logged_in' => true]);

        return redirect()->route('admin.index');
    }

    public function logout()
    {
        session()->forget('admin_logged_in');

        return redirect()->route('admin.login');
    }
}