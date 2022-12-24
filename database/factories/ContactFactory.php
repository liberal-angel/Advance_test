<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->lastName(),
            'last_name' => $this->faker->firstName(),
            'gender_id' => $this->faker->numberBetween(1, 2),
            'email' => $this->faker->safeEmail,
            'postal' => $this->faker->regexify('[0-9]{3}-[0-9]{4}'),
            'address' => $this->faker->streetAddress,
            'building_name' => $this->faker->company,
            'content' => $this->faker->text
        ];
    }
}
