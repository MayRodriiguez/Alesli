<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'telefono'  => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:500'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'      => 'El nombre es obligatorio.',
            'email.required'     => 'El correo electrónico es obligatorio.',
            'email.unique'       => 'Este correo ya está registrado.',
            'telefono.required'  => 'El teléfono es obligatorio.',
            'direccion.required' => 'La dirección es obligatoria.',
            'password.required'  => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'telefono'  => $request->telefono,
            'direccion' => $request->direccion,
            'password'  => Hash::make($request->password),
            'role'      => 'cliente',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('user.shop', absolute: false));
    }
}