<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin(): Response
    {
        return view('auth.login');
    }

    /**
     *
     * @param  \App\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return back()->withErrors([
                'email' => 'Логин или пароль введен не верно',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistration(): Response
    {
        return view('auth.registration');
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registration(RegisterRequest $request): RedirectResponse
    {
        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        Auth::login($newUser);

        $newUser->createToken('authToken');

        return redirect()->route('dashboard')->withSuccess('Вы зарегистрировались');
    }

    /**
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('home');
    }

}
