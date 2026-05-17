<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Depuración: guardar en log para ver qué rol tiene
            Log::info('Usuario logueado: ' . $user->email . ' - Rol: ' . $user->role);
            
            // Redirigir según el rol usando URLs directas
            if ($user->role == 'admin') {
                return redirect('http://127.0.0.1:8000/admin/dashboard');
            } elseif ($user->role == 'personal') {
                return redirect('http://127.0.0.1:8000/personal/dashboard');
            } else {
                return redirect('http://127.0.0.1:8000/cliente/dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('http://127.0.0.1:8000/');
    }
}