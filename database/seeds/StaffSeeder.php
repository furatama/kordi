<?php

use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    		DB::table('users')->insert([
            ['username' => "superadmin",'password' => bcrypt('superadmin'), 'access' => '0123456789'],
            ['username' => "admin",'password' => bcrypt('admin'), 'access' => '0123456789'],
            ['username' => "staff",'password' => bcrypt('staff'), 'access' => '0123456789'],
        ]);
    }
}
