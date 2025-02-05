<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Heartbeat;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Heartbeat>
 */
class HeartbeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'application_key' => $this->faker->word,
            'heartbeat_key' => $this->faker->word,
            'unhealthy_after_minutes' => $this->faker->numberBetween(1, 60),
            'last_check_in' => now()->subMinutes($this->faker->numberBetween(1, 120)),
        ];
    }
}
