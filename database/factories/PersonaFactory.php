<?php

namespace Database\Factories;

use App\Models\Persona;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Persona::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->numberBetween(1,999),
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->lastname,
            'celular' => $this->faker->numberBetween(3000000000,3999999999),
            'direccion' => $this->faker->streetAddress,
            'barrio' => $this->faker->streetName,  
        ];
    }
}
