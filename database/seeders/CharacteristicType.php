<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CharacteristicType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=['длина','ширина','вес','цвет','размер'];
        //
        foreach ($array as $item) {
            $type = new \App\Models\CharacteristicType();
            $type->name = $item;
            $type->save();
        }



    }
}
