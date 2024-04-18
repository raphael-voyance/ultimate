<?php

namespace App\Livewire;

use Livewire\Component;

class GetUserPlace extends Component
{
    public $user;
    public $userContact;
    public $hasPhysicalsProducts;
    public $invoice_status;
    public $checkRequest;

    public function render()
    {
        return view('livewire.components.get-user-place');
    }
}
