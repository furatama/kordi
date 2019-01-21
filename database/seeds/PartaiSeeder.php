<?php

use Illuminate\Database\Seeder;

class PartaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $table->increments('id');
        //     $table->unsignedInteger('nourut');
        //     $table->string('nama');
        //     $table->string('singkatan')->nullable();
        //     $table->string('lambang')->nullable();
        //     $table->softDeletes();
        //     $table->timestamps();


        //
            $path = 'upload/lambang/';
    		DB::table('partai')->insert([
                [
                    'nourut' => 1,
                    'nama' => "Partai Kebangkitan Bangsa",
                    'singkatan' => "PKB",
                    'lambang' => $path . 'partai_1'
                ],
                [
                    'nourut' => 2,
                    'nama' => "Partai Gerakan Indonesia Raya",
                    'singkatan' => "Gerindra",
                    'lambang' => $path . 'partai_2'
                ],
                [
                    'nourut' => 3,
                    'nama' => "Partai Demokrasi Indonesia Perjuangan",
                    'singkatan' => "PDIP",
                    'lambang' => $path . 'partai_3'
                ],
                [
                    'nourut' => 4,
                    'nama' => "Partai Golongan Karya",
                    'singkatan' => "Golkar",
                    'lambang' => $path . 'partai_4'
                ],
                [
                    'nourut' => 5,
                    'nama' => "Partai Nasional Demokrat",
                    'singkatan' => "Nasdem",
                    'lambang' => $path . 'partai_5'
                ],
                [
                    'nourut' => 6,
                    'nama' => "Partai Garuda",
                    'singkatan' => "Garuda",
                    'lambang' => $path . 'partai_6'
                ],
                [
                    'nourut' => 7,
                    'nama' => "Partai Berkarya",
                    'singkatan' => "Berkarya",
                    'lambang' => $path . 'partai_7'
                ],
                [
                    'nourut' => 8,
                    'nama' => "Partai Keadilan Sejahtra",
                    'singkatan' => "PKS",
                    'lambang' => $path . 'partai_8'
                ],
                [
                    'nourut' => 9,
                    'nama' => "Partai Persatuan Indonesia",
                    'singkatan' => "Perindo",
                    'lambang' => $path . 'partai_9'
                ],
                [
                    'nourut' => 10,
                    'nama' => "Partai Persatuan Pembangunan",
                    'singkatan' => "PPP",
                    'lambang' => $path . 'partai_10'
                ],
                [
                    'nourut' => 11,
                    'nama' => "Partai Solidaritas Indonesia",
                    'singkatan' => "PSI",
                    'lambang' => $path . 'partai_11'
                ],
                [
                    'nourut' => 12,
                    'nama' => "Partai Amanat Nasional",
                    'singkatan' => "PAN",
                    'lambang' => $path . 'partai_12'
                ],
                [
                    'nourut' => 13,
                    'nama' => "Partai Hati Nurani Rakyat",
                    'singkatan' => "Hanura",
                    'lambang' => $path . 'partai_13'
                ],
                [
                    'nourut' => 14,
                    'nama' => "Partai Demokrat",
                    'singkatan' => "Demokrat",
                    'lambang' => $path . 'partai_14'
                ],
        ]);
    }
}