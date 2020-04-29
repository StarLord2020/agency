<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->firstName,
        'surname'=>$faker->lastName,
        'patronymic'=>$faker->name,
        'email' => $faker->unique()->safeEmail,
        'password'=>$faker->password,
        'grade_id'=>'1',
        'birthday'=>$faker->dateTime,
        'sex'=>'Мужчина'
    ];
});
