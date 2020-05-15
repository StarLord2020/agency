<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles=[
           ['name'=>'Работодатель'],
           ['name'=>'Работник'],
           ['name'=>'Менеджер']
       ];

        Role::insert($roles);
    }
}
