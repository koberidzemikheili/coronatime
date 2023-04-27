<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistic>
 */
class StatisticFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'country_code' => fake()->countryCode,
			'country_name' => [
				'en' => fake()->country,
				'es' => fake()->country,
			],
			'confirmed'  => fake()->numberBetween(100, 1000),
			'recovered'  => fake()->numberBetween(50, 500),
			'deaths'     => fake()->numberBetween(10, 100),
			'critical'   => fake()->numberBetween(1, 10),
			'created_at' => fake()->dateTime(),
			'updated_at' => fake()->dateTime(),
		];
	}
}
