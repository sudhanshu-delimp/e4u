<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MassageExcelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $states = [
            ['abbr' => 'WA', 'id' => 3906, 'name' => 'Western Australia'],
            ['abbr' => 'VIC', 'id' => 3903, 'name' => 'Victoria'],
            ['abbr' => 'NSW', 'id' => 3909, 'name' => 'New South Wales'],
        ];

        $state = $this->faker->randomElement($states);

        return [
            'bussiness_name' => $this->faker->company . ' Massage',
            'address' => $this->faker->address,
            'post_code' => $this->faker->numberBetween(2000, 6999),

            'state_abbr' => $state['abbr'],
            'state_id' => $state['id'],
            'territory_name' => $state['name'],

            'mobile_number' => $this->faker->optional()->phoneNumber,
            'business_number' => $this->faker->optional()->phoneNumber,
            'email' => $this->faker->optional()->safeEmail,
            'website' => $this->faker->optional()->url,

            'archive' => $this->faker->randomElement(['true', 'false']),
        ];
    }
}
