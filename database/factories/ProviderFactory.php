<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Enums\OccupationEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(GenderEnum::values()),
            'occupation' => $this->faker->randomElement(OccupationEnum::values()),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'pay_per_hour' => $this->faker->randomFloat(2, 10, 100),
            'profile_image' => $this->faker->imageUrl(200, 200, 'people'),
            'id_card' => $this->faker->imageUrl(640, 480, 'id'),
            'verification_certificate' => $this->faker->imageUrl(640, 480, 'certificate'),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // or Hash::make()
            'long' => $this->faker->longitude(),
            'lat' => $this->faker->latitude(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
