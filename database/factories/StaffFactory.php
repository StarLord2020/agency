<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Staff;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(Staff::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname'=>$faker->name,
        'patronymic'=>$faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'birthday'=>$faker->dateTime,
        'sex'=>'Мужчина',
        'role'=>'Директор',
        'description'=>$faker->text



    ];
});
