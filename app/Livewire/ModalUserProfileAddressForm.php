<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ModalUserProfileAddressForm extends Component
{
    public $ModalUserProfileAddressForm = false;
    public $btnText;

    public $userContact;
    public $number_of_way;
    public $type_of_way;
    public $name_of_way;
    public $postal_code;
    public $city;
    public $country;

    public function mount() {
        if(isset(Auth::user()->profile->contact)) {
            $this->userContact = json_decode(Auth::user()->profile->contact);
        }

        if(isset($this->userContact->address->facturation)) {
            $fa = $this->userContact->address->facturation;
            $this->number_of_way = $fa->number_of_way;
            $this->type_of_way = $fa->type_of_way;
            $this->name_of_way = $fa->name_of_way;
            $this->postal_code = $fa->postal_code;
            $this->city = $fa->city;
            $this->country = $fa->country;
        }
    }

    public function ProfileAddressFormSubmit() {

        $validated = $this->validate([ 
            'number_of_way' => 'required|string',
            'type_of_way' => 'required|string',
            'name_of_way' => 'required|string',
            'postal_code' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string'
        ]);

        if(!$this->userContact) {
            $this->userContact = new \stdClass();
        }

        if(!isset($this->userContact->address)) {
            $this->userContact->address = new \stdClass();
        }

        $this->userContact->address->facturation = $validated;

        //dd($this->userContact->address->facturation);

        Auth::user()->profile->contact = json_encode($this->userContact);
        Auth::user()->profile->save();

        toast()
            ->success('Votre adresse a été enregistrée avec succés.')
            ->pushOnNextPage();

        $this->dispatch('refreshPage');

    }

    public function render()
    {
        return view('livewire.components.modal-user-profile-address-form');
    }
}
