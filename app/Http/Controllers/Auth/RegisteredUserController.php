<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'sexe' => ['required', 'string', 'in:M,F,NB'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::min(8)
                                                                ->letters()
                                                                ->mixedCase()
                                                                ->numbers()
                                                                ->symbols()
                                                                ->uncompromised(3)
                                                            ],
        ]);

        // dd($request->all());

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->roles()->attach(2);
        $user->profile()->create([
            'avatar' => $this->createAvatar($request->sexe),
            'sexe' => $request->sexe,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    private function createAvatar($sexe): string {
        if($sexe === 'M') {
            return asset('/site-images/profile/man-profile-img.jpg');
        }elseif($sexe === 'F') {
            return asset('/site-images/profile/female-profile-img.jpg');
        } else {
            return asset('/site-images/profile/non-binary-profile-img.jpg');
        }
    }
}
