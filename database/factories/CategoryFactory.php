<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $id=null;
        $temp_id=null;
        if( rand(0,1) == 1){
           $temp=Category::all()->pluck('id');
           if(!$temp->isEmpty()) {
               $temp=Category::select('*')
                       ->inRandomOrder()// here is yours limit
                       ->first();
               $temp_id = $temp->id;
           }
        }

        return [
                'parent_id'=>$temp_id,
                'title' => $this->faker->name,
        ];

    }
}
