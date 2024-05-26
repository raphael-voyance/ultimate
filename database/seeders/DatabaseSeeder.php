<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Concern\Tarot;
use App\Models\Role;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Activity;
use App\Models\Interess;
use App\Models\TimeSlot;
use App\Models\Appointment;
use App\Models\DrawCard;
use App\Models\Product;
use App\Models\TarotCard;
use App\Models\TimeSlotDay;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $role2 = Role::create(['name' => 'Consultant', 'slug' => 'consultant']);

        $user1 = User::factory()
        ->has(UserProfile::factory()->count(1), 'profile')
        ->create([
            'first_name' => 'Raphaël',
            'last_name' => 'Henry-Navarro',
            'email' => 'raaphel-praamaanik@outlook.com',
        ]);
        $user1->roles()->attach($role1);

        $user2 = User::factory()
        ->has(UserProfile::factory()->count(1), 'profile')
        ->create([
            'first_name' => 'Aquaman',
            'last_name' => 'Au trident magique',
            'email' => 'test@example.com',
        ]);
        $user2->roles()->attach($role2);

        $users = User::factory()
            ->count(10)
            ->has(UserProfile::factory()->count(1), 'profile')
            ->create();

        foreach($users as $user) {
            $user->roles()->attach($role2);
        }

        Message::factory()
            ->count(100)
            ->create();

        Message::factory()
            ->count(20)
            ->create(
            [
                'sender_id' => null,
                'receiver_id' => 1,
                'sender_phone' => '0606060606',
                'receiver_first_name' => 'Raphaël',
                'receiver_last_name' => 'Henry-Navarro',
                'receiver_email' => 'raaphel-praamaanik@outlook.com',
            ]
        );
        Message::factory()
            ->count(20)
            ->create(
            [
                'receiver_id' => 1,
                'sender_phone' => '0606060606',
                'receiver_first_name' => 'Raphaël',
                'receiver_last_name' => 'Henry-Navarro',
                'receiver_email' => 'raaphel-praamaanik@outlook.com',
            ]
        );

        Message::factory()
            ->count(20)
            ->create(
            [
                'sender_id' => 1,
                'sender_email' => 'raaphel-praamaanik@outlook.com',
                'receiver_id' => null,
                'sender_phone' => '0606060606',
                'sender_first_name' => 'Raphaël',
                'sender_last_name' => 'Henry-Navarro',
            ]
        );
        Message::factory()
            ->count(20)
            ->create(
            [
                'sender_id' => 1,
                'sender_email' => 'raaphel-praamaanik@outlook.com',
                'sender_phone' => '0606060606',
                'sender_first_name' => 'Raphaël',
                'sender_last_name' => 'Henry-Navarro',
            ]
        );

        Interess::factory()
            ->count(10)
            ->has(Activity::factory()->count(5), 'activities')
            ->create();

        $timeSlot1 = TimeSlot::create([
            'start_time' => '09:30:00',
            'end_time' => '10:30:00',
        ]);
        $timeSlot2 = TimeSlot::create([
            'start_time' => '11:30:00',
            'end_time' => '12:30:00',
        ]);
        $timeSlot3 = TimeSlot::create([
            'start_time' => '14:30:00',
            'end_time' => '15:30:00',
        ]);
        $timeSlot4 = TimeSlot::create([
            'start_time' => '16:30:00',
            'end_time' => '17:30:00',
        ]);
        $timeSlot5 = TimeSlot::create([
            'start_time' => '18:30:00',
            'end_time' => '19:30:00',
        ]);

        $dates = [];

        for($i = 0; $i < 100; $i++) {

            $date = fake()->dateTimeBetween('now', '+110 days')->format('Y-m-d');
            if(!in_array($date, array_column($dates, 'day'))) {
                $dates[] = ['day' => $date];
            }
        }

        //dd($dates);

        foreach ($dates as $date) {
            // dump($date);
            TimeSlotDay::firstOrCreate($date);
        }

        $timeSlotsDay = TimeSlotDay::all();

        foreach($timeSlotsDay as $tsd) {
            if($tsd->id <= 10) {
                $tsd->time_slots()->attach([$timeSlot1->id, $timeSlot2->id, $timeSlot5->id], ['available' => false]);
            }else if($tsd->id > 10 && $tsd->id <= 20) {
                $tsd->time_slots()->attach([$timeSlot2->id, $timeSlot5->id], ['available' => true]);
            }else if($tsd->id > 20 && $tsd->id <= 30) {
                $tsd->time_slots()->attach([$timeSlot1->id, $timeSlot2->id, $timeSlot3->id, $timeSlot4->id], ['available' => false]);
            }else if($tsd->id > 30 && $tsd->id <= 40) {
                $tsd->time_slots()->attach([$timeSlot3->id, $timeSlot5->id], ['available' => true]);
            }else if($tsd->id > 40 && $tsd->id <= 50) {
                $tsd->time_slots()->attach([$timeSlot2->id, $timeSlot4->id], ['available' => true]);
            }else if($tsd->id > 50 && $tsd->id <= 60) {
                $tsd->time_slots()->attach([$timeSlot2->id, $timeSlot4->id, $timeSlot5->id], ['available' => false]);
            }
        }

        $invoices = Invoice::factory()
            ->count(50)
            ->create();

        foreach($invoices as $invoice) {
            Appointment::factory()->create([
                'invoice_id' => $invoice->id,
                'time_slot_day_id' => TimeSlotDay::factory()->create()->id,
                'time_slot_id' => TimeSlot::factory()->create()->id,
            ]);
        }

        Product::factory()
            ->count(3)
            ->sequence(
                ['name' => 'Consultation de voyance par téléphone',
                'slug' => 'phone',
                'description' => 'Séance de voyance par téléphone.',
                'price' => 5000,
                'stripe_price_id' => 'price_1OjKbnLzRFCnOVo763YXK88S',
                'type' => 'SERVICE_PRODUCT'],
                ['name' => 'Consultation de voyance par tchat ou visio',
                'slug' => 'tchat',
                'description' => 'Séance de voyance par tchat ou visio.',
                'price' => 5000,
                'stripe_price_id' => 'price_1OjX7aLzRFCnOVo7IgNnkDO0',
                'type' => 'SERVICE_PRODUCT'],
                ['name' => 'Consultation de voyance par email',
                'slug' => 'writing',
                'description' => 'Voyance détaillée par écrit.',
                'price' => 3500,
                'stripe_price_id' => 'price_1P6P6yLzRFCnOVo7AjQe5c4R',
                'type' => 'SERVICE_PRODUCT'],
            )
            ->create();

            $tarot = new Tarot;
            $tarotCards = $tarot->arrayCards;

            foreach($tarotCards as $tarotCard) {
                $tarotCard['interpretationsForTirages'] = json_encode($tarotCard['interpretationsForTirages']);
                $tarotCard['arcanePath'] = json_encode($tarotCard['arcanePath']);
                TarotCard::create($tarotCard);
            }

            $tirageUn = DrawCard::create([
                'name' => 'Tirage en croix', 
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus esse alias voluptatibus fugit nam odio perspiciatis saepe? Perferendis ratione et impedit fuga rerum fugiat delectus nihil consectetur, dolores ipsum laudantium!', 
                'totalSelectedCards' => 4
            ]);

            $tirageDeux = DrawCard::create([
                'name' => 'Tirage de la semaine', 
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus esse alias voluptatibus fugit nam odio perspiciatis saepe? Perferendis ratione et impedit fuga rerum fugiat delectus nihil consectetur, dolores ipsum laudantium!', 
                'totalSelectedCards' => 7
            ]);

            $tirageTrois = DrawCard::create([
                'name' => 'Tirage de la journée', 
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus esse alias voluptatibus fugit nam odio perspiciatis saepe? Perferendis ratione et impedit fuga rerum fugiat delectus nihil consectetur, dolores ipsum laudantium!', 
                'totalSelectedCards' => 1
            ]);
    }
}
