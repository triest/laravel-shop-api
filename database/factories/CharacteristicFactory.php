<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Characteristic;
use App\Models\CharacteristicType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacteristicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Characteristic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        return [
             'type_id'=>rand(1,5),
              'value'=>rand(1,50000)
        ];
    }
}
