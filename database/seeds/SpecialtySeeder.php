<?php

use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties=[
            ['name'=>'Юрист'],
            ['name'=>'Менеджер'],
            ['name'=>'Учитель'],
            ['name'=>'Программист'],
            ['name'=>'Адвокат'],
        ];
        \App\Models\Specialty::insert($specialties);
    }
}
