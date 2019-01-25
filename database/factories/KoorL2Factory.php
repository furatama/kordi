<?php

use Faker\Generator as Faker;

$factory->define(App\KoorL2::class, function (Faker $faker) {
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
        'idl1' => rand(1,App\KoorL1::count()),
        'idtps' => rand(1,App\TPS::count()),
        'created_at' => date('Y-m-d H:i:s',strtotime("2019-01-".rand(10,15))),
    ];
});
