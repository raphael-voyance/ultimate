<?php

namespace App\Concern;

use Illuminate\Support\Str;

class Tarot
{

    public $arrayCards = [];

    public function __construct() {
        $this->arrayCards = [
            1 => [
                'name' => 'Le Bateleur',
                'slug' => Str::slug('Le Bateleur', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/1-le-bateleur.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 1,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            2 => [
                'name' => 'La Papesse',
                'slug' => Str::slug('La Papesse', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/2-la-papesse.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 2,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            3 => [
                'name' => 'L\'Impératrice',
                'slug' => Str::slug('L\'Impératrice', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/3-l-imperatrice.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 3,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            4 => [
                'name' => 'L\'Empereur',
                'slug' => Str::slug('L\'Empereur', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/4-l-empereur.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 4,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            5 => [
                'name' => 'Le Pape',
                'slug' => Str::slug('Le Pape', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/5-le-Pape.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 5,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            6 => [
                'name' => 'L\'Amoureux',
                'slug' => Str::slug('L\'Amoureux', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/6-l-amoureux.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 6,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            7 => [
                'name' => 'Le Chariot',
                'slug' => Str::slug('Le Chariot', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/7-le-Chariot.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 7,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            8 => [
                'name' => 'La Justice',
                'slug' => Str::slug('La Justice', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/8-la-justice.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 8,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            9 => [
                'name' => 'L\'Hermite',
                'slug' => Str::slug('L\'Hermite', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/9-l-hermite.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 9,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            10 => [
                'name' => 'La Roue de Fortune',
                'slug' => Str::slug('La Roue de Fortune', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/10-la-roue-de-fortune.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 10,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            11 => [
                'name' => 'La Force',
                'slug' => Str::slug('La Force', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/11-la-force.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 11,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            12 => [
                'name' => 'Le Pendu',
                'slug' => Str::slug('Le Pendu', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/12-le-pendu.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 12,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            13 => [
                'name' => 'L\'Arcane sans nom',
                'slug' => Str::slug('L\'Arcane sans nom', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/13-l-arcane-sans-nom.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 13,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            14 => [
                'name' => 'La Tempérance',
                'slug' => Str::slug('La Tempérance', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/14-la-temperance.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 14,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            15 => [
                'name' => 'Le Diable',
                'slug' => Str::slug('Le Diable', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/15-le-diable.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 15,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            16 => [
                'name' => 'La Maison-Dieu',
                'slug' => Str::slug('La Maison-Dieu', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/16-la-maison-dieu.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 16,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            17 => [
                'name' => 'L\'Étoile',
                'slug' => Str::slug('L\'Étoile', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/17-l-etoile.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 17,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            18 => [
                'name' => 'La Lune',
                'slug' => Str::slug('La Lune', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/18-la-lune.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 18,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            19 => [
                'name' => 'Le Soleil',
                'slug' => Str::slug('Le Soleil', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/19-le-soleil.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 19,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            20 => [
                'name' => 'Le Jugement',
                'slug' => Str::slug('Le Jugement', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/20-le-jugement.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 20,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            21 => [
                'name' => 'Le Monde',
                'slug' => Str::slug('Le Monde', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/21-le-monde.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 21,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
            22 => [
                'name' => 'Le Mât',
                'slug' => Str::slug('Le Mât', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/22-le-mat.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 22,
                'interpretationsForTirages' => [
                    'tirage_en_croix' => [
                        'premiere_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'deuxieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'troisieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        'quatrieme_position' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
        ];
    }

    public function calculatePath($dateStr, $currentYear = null) {
        $datas = [];
        // Extrait uniquement l'année, le mois et le jour de la chaîne de date
        
        [$year, $month, $day] = explode("-", $dateStr);

        $birthdate = $day . '/' . $month . '/' . $year;

        // Conversion en nombres
        $year = $currentYear ? intval($currentYear) : intval($year);
        $month = intval($month);
        $day = intval($day);

        $sumBirthdate = $year + $month + $day;

        $arcaneLifePath = $this->reduceNumberBetweenOneToTwentyOne($sumBirthdate);

        if($currentYear) {
            $sumCurrentYear = $currentYear + $month + $day;
            $arcaneAnnualPath = $this->reduceNumberBetweenOneToTwentyOne($sumCurrentYear);
        }else {
            $sumCurrentYear = intval(date("Y")) + $month + $day;
            $arcaneAnnualPath = $this->reduceNumberBetweenOneToTwentyOne($sumCurrentYear);
        }

        $arcaneSumPath = $this->reduceNumberBetweenOneToTwentyOne($arcaneAnnualPath + $arcaneLifePath);

        $tarot = new Tarot;
        $arcaneLifePath = $tarot->getCard($arcaneLifePath);
        $arcaneAnnualPath = $tarot->getCard($arcaneAnnualPath);
        $arcaneSumPath = $tarot->getCard($arcaneSumPath);

        return json_encode($datas = [
            'birthdate' => $birthdate,
            'arcaneLifePath' => $arcaneLifePath,
            'arcaneAnnualPath' => $arcaneAnnualPath,
            'arcaneSumPath' => $arcaneSumPath,
        ]);
    }

    public function getCard($numberOfCard) {
        $card = $this->arrayCards[$numberOfCard];
        return $card;
    }

    private function reduceNumberBetweenOneToTwentyOne($number) {
        if ($number <= 22) {
            return $number;
        } else {
            $sum = 0;
            while ($number > 0) {
                $sum += $number % 10;
                $number = floor($number / 10);
            }
            return $this->reduceNumberBetweenOneToTwentyOne($sum);
        }
    }
}
