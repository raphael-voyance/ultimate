<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;

class FormRegisterUser extends Component
{
    //Login && Registration User Datas
    public $email;
    public $password;
    public $remember;
    public $first_name;
    public $last_name;
    public $password_confirmation;

    //Login User
    public function userLogin()
    {

        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // dd($credentials);

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return $this->dispatch('refreshPage');
        }

        //dd(session('status'));
        session()->flash('error', 'Vos informations de connexion ne correspondent pas. Merci de réessayer.');
        return back()->onlyInput('email');
    }

    //Register User
    public function registerUser()
    {
        $validatedData = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => [
                'required', Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(3)
            ],
            'password_confirmation' => 'same:password',
        ]);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'],),
        ]);

        $avatar = "https://via.placeholder.com/480x480.png/00bb99?text=";
        $avatar .= substr($user->first_name, 0, 1);
        $avatar .= substr($user->last_name, 0, 1);
        $user->roles()->attach(2);
        $user->profile()->create([
            'avatar' => $avatar
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function render()
    {
        return view('livewire.components.form-register-user');
    }
}
