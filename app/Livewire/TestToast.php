<?php

namespace App\Livewire;

use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class TestToast extends Component
{
    use WireToast;

    public function sendCookie(): void
    {
        toast()
            ->success('You earned a cookie! 🍪')
            ->pushOnNextPage();

        redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.test-toast');
    }
}
