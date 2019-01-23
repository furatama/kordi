<?php

use Faker\Generator as Faker;

$factory->define(App\Suara::class, function (Faker $faker) {
    return [
        'suara' => rand(1,50) * 5,
        'tglsuara' => date('Y-m-d'),
        'penanggung' => 'admin',
        'idtps' => rand(1,App\TPS::count()),
        'idcaleg' => rand(1,App\Caleg::count()),
    ];
});