<?php

namespace App\View\Components\Tarot;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Concern\Tarot;

class TarotInterpretation extends Component
{
    public array $cards;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $tarot = new Tarot();
        $this->cards = $tarot->arrayCards;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tarot.tarot-interpretation');
    }
}
