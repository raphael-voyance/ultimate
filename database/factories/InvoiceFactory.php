<?php

namespace Database\Factories;

use App\Concern\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $invoice_maker = new Invoice(1);
        return [
            'user_id' => fake()->numberBetween(2, 10),
            'ref' => $invoice_maker->get_ref(),
            'total_price' => fake()->randomNumber(4),
            'payment_invoice_token' => fake()->unique()->uuid,
            'status' => fake()->randomElement(['PENDING', 'PAID', 'REFUNDED', 'CANCELLED', 'FREE']),
        ];
    } 
}
