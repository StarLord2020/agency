<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Classroom;
use Faker\Generator as Faker;

$factory->define(Classroom::class, function (Faker $faker) {
    return [
        'name'=>'123'
    ];
});
