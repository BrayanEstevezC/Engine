<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // Enviar correo de bienvenida
        Mail::send('emails.welcome', ['user' => $user], function ($message) use ($user) {
            $message->to($user->email)->subject('Bienvenido a EngineAir');
        });
        
        return redirect()->route('home')->with('status', 'Te has registrado correctamente con el correo: ' . $user->email);
    }

    public function verifyEmail($id, $hash)
    {
        $user = User::find($id);

        if (!$user || !hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('home')->with('error', 'El enlace de verificación no es válido.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home')->with('status', 'El correo ya ha sido verificado anteriormente.');
        }

        $user->markEmailAsVerified();

        return redirect()->route('home')->with('status', 'Tu correo ha sido verificado correctamente.');
    }
}