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
        $this->call(StaffSeeder::class);
        $this->call(PartaiSeeder::class);
        $this->call(CalegSeeder::class);

    	factory(App\KoorL1::class, 2)->create();
        factory(App\KoorL2::class, 20)->create();
        factory(App\Pemilih::class, 100)->create();
        factory(App\Suara::class, 1000)->create();
    }
}
