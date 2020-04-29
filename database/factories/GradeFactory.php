<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Grade;
use Faker\Generator as Faker;

$factory->define(Grade::class, function (Faker $faker) {
    return [
        'name'=>'342',
        'staff_id'=>1,
        'classroom_id'=>1
    ];
});
