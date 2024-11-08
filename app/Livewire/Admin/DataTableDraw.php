<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\DrawCard;
use App\Models\TarotCard;

class DataTableDraw extends Component
{
    public $draws;
    public $headers;
    public $cards;

    public function mount() {
        $this->cards = TarotCard::all();
        $this->draws = DrawCard::all();

        foreach ($this->draws as $draw) {
            $interpretations = [];
            //$slugWithUnderscores = str_replace('-', '_', $draw->slug);
            $draw->interpretationIsCompleted = true;

            foreach ($this->cards as $card) {
                $interpretationsData = json_decode($card->interpretationsForDrawingCard, true);
                
                if (isset($interpretationsData[$draw->slug])) {
                    $interpretations = $interpretationsData[$draw->slug];
                }
                
                foreach($interpretations as $interpretation) {
                    if(empty($interpretation) || $interpretation == '' || $interpretation == null) {
                        $draw->interpretationIsCompleted = false;
                        break 2;
                    }
                }
            }
        }
    
        
    }

    public function render()
    {
        return view('livewire.admin.data-table-draw');
    }
}
