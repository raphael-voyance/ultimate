<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Concern\Tarot;
use Livewire\Component;
use App\Concern\Numerology;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ModalCreateUser extends Component
{
    public $ModalCreateUser = false;

    public $first_name = '';
    public $last_name = '';
    public $sexe = 'M';
    public $email = '';
    public $phone = '';
    public $birthday = '';
    public $time_of_birth = '';
    public $city_of_birth = '';
    public $native_country = '';

    //Create User
    public function createUser() {

        $validatedData = $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'sexe' => 'required|string|in:M,F,NB',
            'email' => 'required|email|unique:'.User::class,
            'phone' => 'required|string|regex:/^[0-9]{10,15}$/',
            'birthday' => 'nullable|date',
            'time_of_birth' => 'nullable|date_format:H:i',
            'city_of_birth' => 'nullable|string',
            'native_country' => 'nullable|string',
        ]);

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make(Str::random(10)),
        ]);

        $user->roles()->attach(2);
        $user->markEmailAsVerified();

        $astrologyData = [
            'time_of_birth' => $this->time_of_birth,
            'city_of_birth' => $this->city_of_birth,
            'native_country' => $this->native_country,
        ];

        $dateWithoutTime = substr($this->birthday, 0, 10);
        $numerology = (new Numerology())->calculatePath($dateWithoutTime);
        $tarology = (new Tarot())->calculatePath($dateWithoutTime);

        // dd($astrologyData ,$numerology, $tarology,$this->createAvatar($this->sexe));

        $user->profile()->create([
            'avatar' => $this->createAvatar($this->sexe),
            'sexe' => $this->sexe,
            'birthday' => $this->birthday,
            'astrology' => json_encode($astrologyData),
            'numerology' => $numerology,
            'tarology' => $tarology
        ]);

        Password::sendResetLink(
            ['email' => $this->email]
        );
        
        $this->dispatch('refreshPage');
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
        return view('livewire.admin.modal-create-user');
    }
}
