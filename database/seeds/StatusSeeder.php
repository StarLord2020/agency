<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status=[
            ['name'=>'В рассмотрении'],
            ['name'=>'Опубликовано'],
            ['name'=>'Отказано']
        ];
        \Illuminate\Support\Facades\DB::table('statuses')->insert($status);
    }
}
