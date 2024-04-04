<?php

namespace App\Livewire;

use App\Concern\Tarot;
use Livewire\Component;
use Livewire\Attributes\On;

class TarotScope extends Component
{
    public $user;
    public $NumerologyTree;
    public array $cards;
    public array $tarotScope = ['firstTarotLine' => [], 'lastTarotLine' => []];
    public array $yearlyTarotScope = ['firstTarotLine' => [], 'lastTarotLine' => []];

    public function mount()
    {
        if ($this->user->profile->numerology) {
            $this->calculateTaroscope($this->user->profile->numerology);
        }
    }

    private function calculateTaroscope($nt)
    {
        $tarot = new Tarot();

        $tree = json_decode($nt);

        //$tree - Arbre de vie numérologique de l'utilisateur :(array)
        $this->NumerologyTree = $tree;
        //$tarot->arrayCards - Tableau des 22 arcanes majeurs :(array)
        $this->cards = $tarot->arrayCards;

        // Taroscope de naissance
        //$tree->numerologyResults - Phase intermédiaire de calcul :(array)
        $lastKeyTree = (int) array_key_last($tree->numerologyResults);

        $lastLineTree = (array) $tree->numerologyResults[$lastKeyTree];

        //$tree->lifePathResults - Calcul du chemin de vie :(array)
        $lifePathArray = (array) [];
        foreach ($tree->lifePathResults as $line) {
            foreach ($line as $num) {
                $lifePathArray[] = $num;
            };
        };

        $tarotScopeFirstLine = [];
        foreach ($lastLineTree as $line) {

            if ($line > 21) {
                continue;
            }

            $tarotScopeFirstLine[] = [
                'num' => $line,
                'card' => $this->cards[$line]
            ];
        };

        $tarotScopeLastLine = [];
        foreach ($lifePathArray as $line) {

            if ($line > 21) {
                continue;
            }

            $tarotScopeLastLine[] = [
                'num' => $line,
                'card' => $this->cards[$line]
            ];
        };

        $this->tarotScope['firstTarotLine'] = array_merge($this->tarotScope['firstTarotLine'], $tarotScopeFirstLine);
        $this->tarotScope['lastTarotLine'] = array_merge($this->tarotScope['lastTarotLine'], $tarotScopeLastLine);

        // Taroscope de l'année
        //$tree->numerologyCurrentYearResults - Phase intermédiaire de calcul :(array)
        $yearlyLastKeyTree = (int) array_key_last($tree->numerologyCurrentYearResults);

        $yearlyLastLineTree = (array) $tree->numerologyCurrentYearResults[$yearlyLastKeyTree];

        //$tree->numerologyCurrentYearResults - Calcul du chemin de l'année :(array)
        $yearlyLifePathArray = (array) [];
        foreach ($tree->currentYearResults as $line) {
            foreach ($line as $num) {
                $yearlyLifePathArray[] = $num;
            };
        };

        $yearlyTarotScopeFirstLine = [];
        foreach ($yearlyLastLineTree as $line) {

            if ($line > 21) {
                continue;
            }

            $yearlyTarotScopeFirstLine[] = [
                'num' => $line,
                'card' => $this->cards[$line]
            ];
        };

        $yearlyTarotScopeLastLine = [];
        foreach ($yearlyLifePathArray as $line) {

            if ($line > 21) {
                continue;
            }

            $yearlyTarotScopeLastLine[] = [
                'num' => $line,
                'card' => $this->cards[$line]
            ];
        };

        $this->yearlyTarotScope['firstTarotLine'] = array_merge($this->yearlyTarotScope['firstTarotLine'], $yearlyTarotScopeFirstLine);
        $this->yearlyTarotScope['lastTarotLine'] = array_merge($this->yearlyTarotScope['lastTarotLine'], $yearlyTarotScopeLastLine);

        // dump(
        //     'L\'arbre complet : ', $tree,
        //     '$tree->numerologyResults - Phase intermédiaire de calcul : ', $tree->numerologyResults,
        //     '$lastKeyTree - Dernière clef du tableau $tree->numerologyResults : ', $lastKeyTree,
        //     '$lastLineTree - Dernière ligne du tableau $tree->numerologyResults : ', $lastLineTree,
        //     '$lifePathArray - Calcul du chemin de vie : ', $lifePathArray,

        //     'Tableau des cartes : ', $tarot->arrayCards,
        //     'Nombres de cartes : ', count($tarot->arrayCards),

        //     '1ere ligne du tarotscope', $tarotScopeFirstLine,
        //     '2eme ligne du tarotscope', $tarotScopeLastLine,
        //     'TarotScope', $this->tarotScope,
        //     'TarotScope annuel', $this->yearlyTarotScope,
        // );

    }

    #[On('refresh-tree-numerology')]
    public function updateTaroscope($tree)
    {
        $this->tarotScope = ['firstTarotLine' => [], 'lastTarotLine' => []];
        $this->yearlyTarotScope = ['firstTarotLine' => [], 'lastTarotLine' => []];
        $this->calculateTaroscope($tree);
    }

    public function render()
    {
        return view('livewire.tarot-scope');
    }
}
