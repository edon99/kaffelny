<?php

namespace Database\Factories;

use App\Enums\OfferStateEnum;
use App\Enums\ServiceEnum;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'service' => $this->faker->randomElement(ServiceEnum::values()),
            'hours' => $this->faker->numberBetween(1, 8),
            'description' => $this->faker->optional()->paragraph(),
            'long' => $this->faker->optional()->longitude(),
            'lat' => $this->faker->optional()->latitude(),
            'user_id' => User::factory(),
            'provider_id' => Provider::factory(),
            'state' => OfferStateEnum::PENDING,

        ];
    }
}
