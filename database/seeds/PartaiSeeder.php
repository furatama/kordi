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
        // $table->increments('id');
        //     $table->unsignedInteger('nourut');
        //     $table->string('nama');
        //     $table->string('singkatan')->nullable();
        //     $table->string('lambang')->nullable();
        //     $table->softDeletes();
        //     $table->timestamps();


        //
    		DB::table('partai')->insert([
                [
                    'nourut' => 1,
                    'nama' => "Partai Kebangkitan Bangsa",
                    'singkatan' => "PKB",
                    'lambang' => 'partai_1.jpg'
                ],
                [
                    'nourut' => 2,
                    'nama' => "Partai Gerakan Indonesia Raya",
                    'singkatan' => "Gerindra",
                    'lambang' => 'partai_2.jpg'
                ],
                [
                    'nourut' => 3,
                    'nama' => "Partai Demokrasi Indonesia Perjuangan",
                    'singkatan' => "PDIP",
                    'lambang' => 'partai_3.jpg'
                ],
                [
                    'nourut' => 4,
                    'nama' => "Partai Golongan Karya",
                    'singkatan' => "Golkar",
                    'lambang' => 'partai_4.jpg'
                ],
                [
                    'nourut' => 5,
                    'nama' => "Partai Nasional Demokrat",
                    'singkatan' => "Nasdem",
                    'lambang' => 'partai_5.jpg'
                ],
                [
                    'nourut' => 6,
                    'nama' => "Partai Garuda",
                    'singkatan' => "Garuda",
                    'lambang' => 'partai_6.jpg'
                ],
                [
                    'nourut' => 7,
                    'nama' => "Partai Berkarya",
                    'singkatan' => "Berkarya",
                    'lambang' => 'partai_7.jpg'
                ],
                [
                    'nourut' => 8,
                    'nama' => "Partai Keadilan Sejahtra",
                    'singkatan' => "PKS",
                    'lambang' => 'partai_8.jpg'
                ],
                [
                    'nourut' => 9,
                    'nama' => "Partai Persatuan Indonesia",
                    'singkatan' => "Perindo",
                    'lambang' => 'partai_9.jpg'
                ],
                [
                    'nourut' => 10,
                    'nama' => "Partai Persatuan Pembangunan",
                    'singkatan' => "PPP",
                    'lambang' => 'partai_10.jpg'
                ],
                [
                    'nourut' => 11,
                    'nama' => "Partai Solidaritas Indonesia",
                    'singkatan' => "PSI",
                    'lambang' => 'partai_11.jpg'
                ],
                [
                    'nourut' => 12,
                    'nama' => "Partai Amanat Nasional",
                    'singkatan' => "PAN",
                    'lambang' => 'partai_12.jpg'
                ],
                [
                    'nourut' => 13,
                    'nama' => "Partai Hati Nurani Rakyat",
                    'singkatan' => "Hanura",
                    'lambang' => 'partai_13.jpg'
                ],
                [
                    'nourut' => 14,
                    'nama' => "Partai Demokrat",
                    'singkatan' => "Demokrat",
                    'lambang' => 'partai_14.jpg'
                ],
        ]);
    }
}