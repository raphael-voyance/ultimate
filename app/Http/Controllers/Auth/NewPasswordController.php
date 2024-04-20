<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', Rules\Password::min(8)
                                                                ->letters()
                                                                ->mixedCase()
                                                                ->numbers()
                                                                ->symbols()
                                                                ->uncompromised(3)],
        ]);
        
        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Update the user's password and remember token
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(60);
        $user->save();

        // Dispatch an event for password reset
        event(new PasswordReset($user));

        // Redirect the user to the login page with a success message
        return redirect()->route('login')->with('status', 'Votre mot de passe a été réinitialisé avec succès.');

    }
}
