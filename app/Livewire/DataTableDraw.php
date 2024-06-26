<?php

namespace App\Livewire;

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
    
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nom du tirage'],
            ['key' => 'slug', 'label' => 'Slug du tirage'],
            ['key' => 'interpretations', 'label' => 'Interprétations complètes'],
            ['key' => 'active', 'label' => 'Publié'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
    }

    public function render()
    {
        return view('livewire.data-table');
    }
}
