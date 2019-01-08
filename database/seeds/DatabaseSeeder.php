<?php

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
        $this->call(RegionSeeder::class);

    	factory(App\KoorL1::class, 10)->create();
        factory(App\KoorL2::class, 100)->create();
        factory(App\Pemilih::class, 1000)->create();
    }
}
