<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalUserProfileContactForm extends Component
{
    public $ModalUserProfileContactForm = false;
    public $btnText;

    public $userContact;
    public $phone;
    public $email;

    public function mount() {
        if(isset(Auth::user()->profile->contact)) {
            $this->userContact = json_decode(Auth::user()->profile->contact);
        }
        if(isset($this->userContact->phone)) {
            $this->phone = $this->userContact->phone;
        }

        $this->email = Auth::user()->email;
        
    }

    public function ProfileContactFormSubmit() {
        if(Auth::user()->email != $this->email) {
            $validated = $this->validate([ 
                'email' => 'required|min:3|email|unique:users',
                'phone' => 'required|min:10|max:10',
            ]);

            $user = Auth::user();
            $user->email = $validated['email'];
            $user->save();

            if(!$this->userContact) {
                $this->userContact = new \stdClass();
            }

            $this->userContact->phone = $validated['phone'];

            Auth::user()->profile->contact->phone = json_encode($this->userContact->phone);
            Auth::user()->profile->save();

            $this->dispatch('refreshPage');

        }else {
            $validated = $this->validate([
                'phone' => 'required|min:10|max:10',
            ]);

            if(!$this->userContact) {
                $this->userContact = new \stdClass();
            }

            $this->userContact->phone = $validated['phone'];

            Auth::user()->profile->contact = json_encode($this->userContact);
            Auth::user()->profile->save();

            toast()
                ->success('Vos informations de contact ont été enregistrées avec succés.')
                ->pushOnNextPage();

            $this->dispatch('refreshPage');
        }

    }

    public function render()
    {
        return view('livewire.components.modal-user-profile-contact-form');
    }
}
