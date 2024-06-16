<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DrawCard;
use App\Models\TarotCard;

class DataTable extends Component
{
    public $draws;
    public $headers;
    public $cards;

    public function mount() {
        $this->cards = TarotCard::all();
        $this->draws = DrawCard::all();

        foreach ($this->draws as $draw) {
            $interpretations = 'N/A';
            $slugWithUnderscores = str_replace('-', '_', $draw->slug);

            foreach ($this->cards as $card) {
                $interpretationsData = json_decode($card->interpretationsForDrawingCard, true);
                
                if (isset($interpretationsData[$slugWithUnderscores])) {
                    $interpretations = $interpretationsData[$slugWithUnderscores];
                    break;
                }
            }

            $draw->interpretations = $interpretations;
        }
        
    
        $this->headers = [
            ['key' => 'id', 'label' => '#'],
            ['key' => 'name', 'label' => 'Nom du tirage'],
            ['key' => 'slug', 'label' => 'Slug du tirage'],
            ['key' => 'interpretations', 'label' => 'Interprétations'],
            ['key' => 'actions', 'label' => 'Actions'],
        ];
    }
    


    public function render()
    {
        return view('livewire.data-table');
    }
}
