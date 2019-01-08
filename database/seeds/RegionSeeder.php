<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kecamatan')->insert([
            'nama' => "Kuta Utara"
        ]);

        DB::table('desa')->insert([
            ['idkecamatan'=>1,'nama' => "Dalung"],
            ['idkecamatan'=>1,'nama' => "Tibubeneng"],
            ['idkecamatan'=>1,'nama' => "Kerobokan"],
            ['idkecamatan'=>1,'nama' => "Kerobokan Kaja"],
            ['idkecamatan'=>1,'nama' => "Kerobokan Kelod"],
            ['idkecamatan'=>1,'nama' => "Canggu"],
        ]);

        $listBanjar = [
            ['iddesa'=>1,'nama' => "Banjar Pegending"],
            ['iddesa'=>1,'nama' => "Banjar Tuka"],
            ['iddesa'=>1,'nama' => "Banjar Penyirian"],
            ['iddesa'=>1,'nama' => "Banjar Dukuh"],
            ['iddesa'=>1,'nama' => "Banjar Dukuh"],
            ['iddesa'=>1,'nama' => "Banjar Padang Bali"],
            ['iddesa'=>1,'nama' => "Banjar Lebak"],
            ['iddesa'=>1,'nama' => "Banjar Kaja"],
            ['iddesa'=>1,'nama' => "Banjar Tegeh"],
            ['iddesa'=>1,'nama' => "Banjar Untal-untal"],
            ['iddesa'=>1,'nama' => "Banjar Kuanji"],
            ['iddesa'=>1,'nama' => "TK Mekar Jaya"],
            ['iddesa'=>1,'nama' => "Banjar Gaji"],
            ['iddesa'=>1,'nama' => "Banjar Pendem"],
            ['iddesa'=>1,'nama' => "Banjar Tegal Jaya"],
            ['iddesa'=>1,'nama' => "Dalem Penataran"],
            ['iddesa'=>1,'nama' => "Banjar Celuk"],
            ['iddesa'=>1,'nama' => "Banjar Tegal Luih"],
            ['iddesa'=>1,'nama' => "Banjar BN Kangin"],
            ['iddesa'=>1,'nama' => "Banjar BN Kauh"],
            ['iddesa'=>1,'nama' => "SDN 6 Dalung"],
            ['iddesa'=>1,'nama' => "Banjar Camas Kauh"],
            ['iddesa'=>1,'nama' => "Banjar Lingga Bumi"],

            ['iddesa'=>2,'nama' => "Balai Banjar Dawas"],
            ['iddesa'=>2,'nama' => "Balai Banjar Tibubeneng"],
            ['iddesa'=>2,'nama' => "Balai Banjar Kulibul Kangin"],
            ['iddesa'=>2,'nama' => "Balai Banjar Aseman Kawan"],
            ['iddesa'=>2,'nama' => "Balai Banjar Tandeg"],
            ['iddesa'=>2,'nama' => "SD No 2 Tibubeneng"],
            ['iddesa'=>2,'nama' => "Balai Banjar Canggu Permai"],
            ['iddesa'=>2,'nama' => "GOR Juwita Canggu Permai"],
            ['iddesa'=>2,'nama' => "Balai Banjar Pelambingan"],
            ['iddesa'=>2,'nama' => "Balai Banjar Tegal Gundul"],

            ['iddesa'=>3,'nama' => "Lingkungan Kesambi"],
            ['iddesa'=>3,'nama' => "Lingkungan Gede"],
            ['iddesa'=>3,'nama' => "Lingkungan Tegeh"],
            ['iddesa'=>3,'nama' => "Lingkungan Kancil"],
            ['iddesa'=>3,'nama' => "Lingkungan Campuan"],
            ['iddesa'=>3,'nama' => "Lingkungan Padang"],
            ['iddesa'=>3,'nama' => "Lingkungan Peliatan"],
            ['iddesa'=>3,'nama' => "Lingkungan Anyar Kelod"],
            ['iddesa'=>3,'nama' => "Lingkungan Anyar Kaja"],
            ['iddesa'=>3,'nama' => "Lingkungan Anyar Kaja"],
            ['iddesa'=>3,'nama' => "Lingkungan Silayukti"],

            ['iddesa'=>4,'nama' => "Banjar Padang Lestari"],
            ['iddesa'=>4,'nama' => "Banjar Muding Kelod"],
            ['iddesa'=>4,'nama' => "Banjar Muding Tengah"],
            ['iddesa'=>4,'nama' => "Banjar Muding Kaja"],
            ['iddesa'=>4,'nama' => "Banjar Muding Kaja"],
            ['iddesa'=>4,'nama' => "Banjar Muding Mekar"],
            ['iddesa'=>4,'nama' => "Banjar Petingan"],
            ['iddesa'=>4,'nama' => "Banjar Batu Bidak"],
            ['iddesa'=>4,'nama' => "Banjar Jambe"],
            ['iddesa'=>4,'nama' => "SD No 3 Kerobokan"],
            ['iddesa'=>4,'nama' => "Banjar Batuculung"],
            ['iddesa'=>4,'nama' => "Banjar Gadon"],
            ['iddesa'=>4,'nama' => "Banjar Surya Bhuwana"],
            ['iddesa'=>4,'nama' => "Banjar Tegal Sari"],
            ['iddesa'=>4,'nama' => "Banjar Tegal Permai"],
            ['iddesa'=>4,'nama' => "Banjar Wira Bhuana"],
            ['iddesa'=>4,'nama' => "Banjar Blubuh Sari"],
            ['iddesa'=>4,'nama' => "Banjar Bhuana Asti"],
            ['iddesa'=>4,'nama' => "Banjar Bhuana Shanti"],
            ['iddesa'=>4,'nama' => "Banjar Bumi Kerta"],
            ['iddesa'=>4,'nama' => "Banjar Bhineka Asri"],

            ['iddesa'=>5,'nama' => "Balai Banjar Kuwum"],
            ['iddesa'=>5,'nama' => "Balai Banjar Dukuh sari"],
            ['iddesa'=>5,'nama' => "Balai Banjar Semer"],
            ['iddesa'=>5,'nama' => "Balai Banjar Umalas Kangin"],
            ['iddesa'=>5,'nama' => "Balai Banjar Umalas kauh"],
            ['iddesa'=>5,'nama' => "Balai Banjar Umasari"],
            ['iddesa'=>5,'nama' => "Balai Banjar Batubelig Kangin"],
            ['iddesa'=>5,'nama' => "SD No. 1 Kerobokan Kelod"],
            ['iddesa'=>5,'nama' => "Balai Banjar Taman Merthanadi"],
            ['iddesa'=>5,'nama' => "Balai Banjar Pengubengan Kauh"],
            ['iddesa'=>5,'nama' => "SD No. 3 Kerobokan Kelod"],
            ['iddesa'=>5,'nama' => "Balai Banjar Pengipian"],
            ['iddesa'=>5,'nama' => "Lapas Kerobokan / TPS Khusus"],

            ['iddesa'=>6,'nama' => "Banjar Babakan"],
            ['iddesa'=>6,'nama' => "Banjar Babakan"],
            ['iddesa'=>6,'nama' => "Banjar Umabuluh"],
            ['iddesa'=>6,'nama' => "Banjar Kayu Tulang"],
            ['iddesa'=>6,'nama' => "Banjar Pipitan"],
            ['iddesa'=>6,'nama' => "Banjar Padang Linjong"],
            ['iddesa'=>6,'nama' => "Banjar Canggu"],

        ];

        DB::table('banjar')->insert($listBanjar);

        // for ($i=0; $i < 15; $i++) { 
      		// DB::table('banjar')->insert([
      		// 	'iddesa' => rand(1,6),
        //   	'nama' => "Banjar " . $i
      		// ]);
        // }

        for ($i=1; $i <= 85; $i++) { 
      		DB::table('tps')->insert([
      			'idbanjar' => $i,
          	'nama' => "TPS " . $i
      		]);
        }

    }
}

