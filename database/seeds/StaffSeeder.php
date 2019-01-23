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
            ['username' => "superadmin",'password' => bcrypt('superadmin'), 'access' => 'L1C,L1R,L1D,L1U,L2C,L2R,L2D,L2U,PMC,PMR,PMD,PMU,SDR,SBR,RLC,RLU,RLD,RLR,KBR,KBU,KBC,KBD,KKR,KKU,KKC,KKD,SUR,SUC,SUU,SUD,A,SA'],
            ['username' => "admin",'password' => bcrypt('admin'), 'access' => 'L1C,L1R,L1D,L1U,L2C,L2R,L2D,L2U,PMC,PMR,PMD,PMU,SDR,SBR,RLC,RLU,RLD,RLR,KBR,KBU,KBC,KBD,KKR,KKU,KKC,KKD,SUR,SUC,SUU,SUD,A'],
            ['username' => "staff",'password' => bcrypt('staff'), 'access' => 'L1C,L1R,L1D,L1U,L2C,L2R,L2D,L2U,PMC,PMR,PMD,PMU,SDR,SBR,RLC,RLU,RLD,RLR,KBR,KBU,KBC,KBD,KKR,KKU,KKC,KKD,SUR,SUC,SUU,SUD'],
        ]);
    }
}
