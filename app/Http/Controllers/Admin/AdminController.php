<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if ($user = Auth::user()) {
            $token = $user->tokens()->where('name', 'authToken')->first()->token;
            return view('admin.dashboard', compact('token'));
        }
        return back();
    }

    public function regenerate()
    {
        if ($user = Auth::user()) {
            $user->tokens()->where('name', 'authToken')->first()->delete();
            $user->createToken('authToken');
            return redirect()->route('dashboard');
        }
        return back();
    }
}
