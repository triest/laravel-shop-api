<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=1;$i<8;$i++){
            $category=Characteristic::factory()->make();
            $category->save();
        }
    }
}
