<?php

use Faker\Generator as Faker;

$factory->define(App\Models\FundsManagement::class, function (Faker $faker) {
    return [
    'user_id',
    'type',
    'price',
    'operate',
    'market',
    'updated_at',
    'created_at',
    ];
});
