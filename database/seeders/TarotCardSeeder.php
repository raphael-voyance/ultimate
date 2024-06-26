<?php

namespace Database\Seeders;

use App\Models\TarotCard;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TarotCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayCards = [
            1 => [
                'name' => 'Le Bateleur',
                'slug' => Str::slug('Le Bateleur', $separator = '-', $language = 'fr'),
                'imgPath' => asset('imgs/tarot/1-le-bateleur.jpg'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'numberArcane' => 1,
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'I day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Papesse 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Papesse 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'II day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Papesse 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Papesse 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Papesse 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Papesse 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Papesse 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Impératrice 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Impératrice 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'III day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Impératrice 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Impératrice 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Impératrice 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Impératrice 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Impératrice 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Empereur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Empereur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'IV day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Empereur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Empereur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Empereur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Empereur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Empereur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Pape 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Pape 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'V day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Pape 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Pape 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Pape 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Pape 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Pape 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Amoureux 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Amoureux 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'VI day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Amoureux 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Amoureux 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Amoureux 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Amoureux 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Amoureux 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Chariot 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Chariot 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'VII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Chariot 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Chariot 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Chariot 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Chariot 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Chariot 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Justice 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Justice 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'VIII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Justice 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Justice 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Justice 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Justice 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Justice 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Hermite 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Hermite 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'IX day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Hermite 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Hermite 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Hermite 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Hermite 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Hermite 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Roue de Fortune 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Roue de Fortune 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'X day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Roue de Fortune 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Roue de Fortune 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Roue de Fortune 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Roue de Fortune 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Roue de Fortune 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Force 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Force 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XI day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Force 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Force 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Force 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Force 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Force 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Pendu 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Pendu 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Pendu 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Pendu 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Pendu 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Pendu 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Pendu 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Arcane sans nom 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Arcane sans nom 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XIII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Arcane sans nom 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Arcane sans nom 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Arcane sans nom 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Arcane sans nom 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Arcane sans nom 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Tempérance 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Tempérance 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XIIII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Tempérance 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Tempérance 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Tempérance 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Tempérance 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Tempérance 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Diable 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Diable 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XV day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Diable 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Diable 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Diable 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Diable 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Diable 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Maison-Dieu 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Maison-Dieu 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XVI day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Maison-Dieu 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Maison-Dieu 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Maison-Dieu 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Maison-Dieu 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Maison-Dieu 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'L\'Étoile 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Étoile 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XVII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'L\'Étoile 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'L\'Étoile 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'L\'Étoile 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'L\'Étoile 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'L\'Étoile 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'La Lune 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Lune 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XVIII day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'La Lune 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'La Lune 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'La Lune 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'La Lune 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'La Lune 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Soleil 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Soleil 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XIX day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Soleil 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Soleil 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Soleil 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Soleil 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Soleil 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Jugement 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Jugement 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XX day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Jugement 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Jugement 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Jugement 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Jugement 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Jugement 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Monde 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Monde 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => 'XXI day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Monde 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Monde 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Monde 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Monde 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Monde 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
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
                'interpretationsForDrawingCard' => [
                    'cut' => [
                        '1' => 'Le Mât 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Mât 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.' 
                    ],
                    'tirage-de-la-journee' => [
                        '1' => '0 day : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-de-l-annee' => [
                        '1' => 'Le Bateleur 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Bateleur 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Bateleur 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Bateleur 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Bateleur 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '6' => 'Le Bateleur 6 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '7' => 'Le Bateleur 7 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '8' => 'Le Bateleur 8 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '9' => 'Le Bateleur 9 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '10' => 'Le Bateleur 10 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '11' => 'Le Bateleur 11 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '12' => 'Le Bateleur 12 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                    'tirage-en-croix' => [
                        '1' => 'Le Mât 1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '2' => 'Le Mât 2 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '3' => 'Le Mât 3 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '4' => 'Le Mât 4 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                        '5' => 'Le Mât 5 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    ],
                ],
                'arcanePath' => [
                    'lifePath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.'
                ]
            ],
        ];

        foreach ($arrayCards as $card) {
            TarotCard::create([
                'name' => $card['name'],
                'slug' => $card['slug'],
                'imgPath' => $card['imgPath'],
                'description' => $card['description'],
                'numberArcane' => $card['numberArcane'],
                'interpretationsForDrawingCard' => json_encode($card['interpretationsForDrawingCard']),
                'arcanePath' => json_encode($card['arcanePath'])
            ]);
        }
    }
}
