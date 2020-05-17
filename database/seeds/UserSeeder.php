<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            ['FIO'=>'Иванов Игорь Анатольевич',
              'email'=>'igor_ivanov@gmail.com',
               'birthday'=>'1999-05-03',
                'password'=>\Illuminate\Support\Facades\Hash::make('employer123'),
                'number'=>'+3809991352',
                'address'=>'г.Краматорск,улица Дружбы 10-29',
                'role_id'=>'1'
            ],
            ['FIO'=>'Титенко Александр Андреевич',
                'email'=>'alex@gmail.com',
                'birthday'=>'1999-09-30',
                'password'=>\Illuminate\Support\Facades\Hash::make('employee123'),
                'number'=>'+38034591322',
                'address'=>'г.Краматорск,улица Парковая 59-29',
                'role_id'=>'2'
            ],

            ['FIO'=>'Такмаков Максим Иванович',
                'email'=>'takmakov@gmail.con',
                'birthday'=>'1999-05-20',
                'password'=>\Illuminate\Support\Facades\Hash::make('manager123'),
                'number'=>'+3805642352',
                'address'=>'г.Краматорск,улица Дружбы 11-50',
                'role_id'=>'3'
            ]
        ];

        User::insert($users);
    }
}
