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
    public $sexe;
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
            'sexe' => ['required', 'string', 'in:M,F,NB'],
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

        $user->roles()->attach(2);
        $user->profile()->create([
            'avatar' => $this->createAvatar($validatedData['sexe']),
            'sexe' => $validatedData['sexe'],
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

    public function render()
    {
        return view('livewire.components.form-register-user');
    }
}
