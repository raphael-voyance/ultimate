<?php

namespace App\View\Components\Structure;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Hero extends Component
{
    public $messages = [
        "1 - Dans une vallée cachée au creux des montagnes argentées, les étoiles s'assemblèrent en une danse céleste, illuminant la nuit d'une lueur mystique. Les fées, petites créatures de lumière aux ailes chatoyantes, éclairent le ciel de leurs rires cristallins.",
        "2 - Les arbres centenaires murmurent des contes anciens aux feuilles dorées qui frissonnent dans la brise magique. Les rivières coulent en cascade, leurs eaux scintillantes révélant des secrets enchantés à ceux qui écoutent attentivement.",
        "3 - Au cœur de la forêt d'émeraude, un jardin féerique éclot chaque nuit avec des fleurs qui s'ouvrent au clair de lune, révélant des pétales chatoyants qui captent les rêves et les transforment en étoiles.",
        "4 - Des licornes aux crinières de soie et aux yeux étoilés galopent joyeusement à travers les prairies éternelles, laissant derrière elles une traînée d'étincelles qui embellissent le paysage de leur passage.",
        "5 - Une bibliothèque magique, perchée au sommet d'une colline éthérée, renferme des livres dont les pages brillent de mille feux. Chaque mot prononcé à haute voix crée des échos de rires enchantés.",
        "6 - Les maisons des lutins, construites avec des champignons lumineux, s'animent la nuit avec des lumières douces et des festins enchantés. Les rires et les chants résonnent à travers la clairière, créant une symphonie joyeuse.",
        "7 - Un dragon bienveillant, aux écailles chatoyantes, veille sur un trésor de rêves exaucés au sommet d'une montagne aux reflets irisés. Les éclats de ses ailes répandent des éclats de bonheur dans tout le royaume.",
        "8 - Sous le pont arc-en-ciel, les farfadets organisent des fêtes scintillantes où les éclats de rire sont échangés contre des éclats d'étoiles. Chaque invité repart avec une poignée de poussière de fée, un souvenir enchanté qui éclaire le quotidien.",
    ];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.structure.hero');
    }
}

