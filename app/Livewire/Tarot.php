<?php

namespace App\Livewire;

use Livewire\Component;
use App\Concern\Tarot as TarotCard;

class Tarot extends Component
{
    private $tc;
    public $cards;

    public function __construct()
    {
        $this->tc = new TarotCard;
        $this->cards = $this->tc->cards;
    }

    


    public function render()
    {
        //dd($this->cards);
        return view('livewire.tarot');
    }
}
