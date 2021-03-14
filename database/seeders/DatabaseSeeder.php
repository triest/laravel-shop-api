<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
                [
                        CharacteristicType::class,
                        CharacteristicSeeder::class,
                    //    CategorySeeder::class,
                        ProductSeeder::class
                ]
        );
    }
}
