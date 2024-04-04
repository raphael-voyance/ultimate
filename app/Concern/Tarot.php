<?php

namespace App\Concern;

use Illuminate\Support\Str;

class Tarot
{

    public $arrayCards = [];

    public function __construct() {
        $this->arrayCards = [
            0 => [
                'name' => 'Le Mât',
                'slug' => Str::slug('Le Mât', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/22-le-mat.jpg')
            ],
            1 => [
                'name' => 'Le Bateleur',
                'slug' => Str::slug('Le Bateleur', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/1-le-bateleur.jpg')
            ],
            2 => [
                'name' => 'La Papesse',
                'slug' => Str::slug('La Papesse', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/2-la-papesse.jpg')
            ],
            3 => [
                'name' => 'L\'Impératrice',
                'slug' => Str::slug('L\'Impératrice', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/3-l-imperatrice.jpg')
            ],
            4 => [
                'name' => 'L\'Empereur',
                'slug' => Str::slug('L\'Empereur', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/4-l-empereur.jpg')
            ],
            5 => [
                'name' => 'Le Pape',
                'slug' => Str::slug('Le Pape', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/5-le-Pape.jpg')
            ],
            6 => [
                'name' => 'L\'Amoureux',
                'slug' => Str::slug('L\'Amoureux', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/6-l-amoureux.jpg')
            ],
            7 => [
                'name' => 'Le Chariot',
                'slug' => Str::slug('Le Chariot', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/7-le-Chariot.jpg')
            ],
            8 => [
                'name' => 'La Justice',
                'slug' => Str::slug('La Justice', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/8-la-justice.jpg')
            ],
            9 => [
                'name' => 'L\'Hermite',
                'slug' => Str::slug('L\'Hermite', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/9-l-hermite.jpg')
            ],
            10 => [
                'name' => 'La Roue de Fortune',
                'slug' => Str::slug('La Roue de Fortune', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/10-la-roue-de-fortune.jpg')
            ],
            11 => [
                'name' => 'La Force',
                'slug' => Str::slug('La Force', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/11-la-force.jpg')
            ],
            12 => [
                'name' => 'Le Pendu',
                'slug' => Str::slug('Le Pendu', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/12-le-pendu.jpg')
            ],
            13 => [
                'name' => 'L\'Arcane sans nom',
                'slug' => Str::slug('L\'Arcane sans nom', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/13-l-arcane-sans-nom.jpg')
            ],
            14 => [
                'name' => 'La Tempérance',
                'slug' => Str::slug('La Tempérance', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/14-la-temperance.jpg')
            ],
            15 => [
                'name' => 'Le Diable',
                'slug' => Str::slug('Le Diable', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/15-le-diable.jpg')
            ],
            16 => [
                'name' => 'La Maison-Dieu',
                'slug' => Str::slug('La Maison-Dieu', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/16-la-maison-dieu.jpg')
            ],
            17 => [
                'name' => 'L\'Étoile',
                'slug' => Str::slug('L\'Étoile', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/17-l-etoile.jpg')
            ],
            18 => [
                'name' => 'La Lune',
                'slug' => Str::slug('La Lune', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/18-la-lune.jpg')
            ],
            19 => [
                'name' => 'Le Soleil',
                'slug' => Str::slug('Le Soleil', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/19-le-soleil.jpg')
            ],
            20 => [
                'name' => 'Le Jugement',
                'slug' => Str::slug('Le Jugement', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/20-le-jugement.jpg')
            ],
            21 => [
                'name' => 'Le Monde',
                'slug' => Str::slug('Le Monde', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/21-le-monde.jpg')
            ]
        ];
    }
}
