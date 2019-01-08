<?php

use Faker\Generator as Faker;

$factory->define(App\Pemilih::class, function (Faker $faker) {
    return [
    		'nik' => $faker->nik,
        'namalengkap' => $faker->name,
        'jeniskelamin' => $faker->randomElement(['L' ,'P']),
        'alamat' => $faker->streetAddress,
        'kontak' => json_encode([
        	['tipe'=>'telp','kontak'=>$faker->phoneNumber],
        	['tipe'=>'wa','kontak'=>$faker->phoneNumber],
            ['tipe'=>'e@','kontak'=>$faker->email],
        ]),
        'idbanjar' => rand(1,App\Banjar::count()),
        'iddesa' => rand(1,App\Desa::count()),
        'idtps' => rand(1,App\TPS::count()),
        'idl2' => rand(1,App\KoorL2::count()),
    ];
});
