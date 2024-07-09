<?php

namespace Database\Seeders;

use App\Models\Numerology;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class NumerologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayNumbers = [
            1 => [
                'name' => 'Un',
                'slug' => Str::slug('un', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 1,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            2 => [
                'name' => 'Deux',
                'slug' => Str::slug('deux', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 2,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            3 => [
                'name' => 'Trois',
                'slug' => Str::slug('trois', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 3,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            4 => [
                'name' => 'Quatre',
                'slug' => Str::slug('quatre', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 4,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            5 => [
                'name' => 'Cinq',
                'slug' => Str::slug('cinq', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 5,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            6 => [
                'name' => 'Six',
                'slug' => Str::slug('six', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 6,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            7 => [
                'name' => 'Sept',
                'slug' => Str::slug('sept', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 7,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            8 => [
                'name' => 'Huit',
                'slug' => Str::slug('huit', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 8,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
            9 => [
                'name' => 'Neuf',
                'slug' => Str::slug('neuf', $separator = '-', $language = 'fr'),
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                'number' => 9,
                'interpretations' => [
                    'lifePath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'annualPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                    'sumPath' => '1 : Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque alias quaerat totam ex vero incidunt iusto minima laboriosam tempore voluptatem. Fuga ut nostrum quibusdam alias natus non quo reprehenderit provident.',
                ],
            ],
        ];

        foreach ($arrayNumbers as $num) {
            Numerology::create([
                'name' => $num['name'],
                'slug' => $num['slug'],
                'description' => $num['description'],
                'number' => $num['number'],
                'interpretations' => json_encode($num['interpretations'])
            ]);
        }
    }
}
