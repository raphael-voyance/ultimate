<?php

namespace App\View\Components\Tarot;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Concern\Tarot as TarotCard;

class DrawingCard extends Component
{
    private $tc;
    public $cards;
    public $drawCards;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->tc = new TarotCard;
        $this->cards = $this->tc->cards;
        $this->drawCards = $this->tc->drawingCards;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tarot.drawing-card');
    }
}
