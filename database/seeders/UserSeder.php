<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Domla",
            'email' => 'domla@ubtuit.uz',
            'password' => Hash::make('domla123'),
        ]);
        DB::table('users')->insert([
            'name' => "Mudir",
            'role' => 'mudir',
            'email' => 'mudir@ubtuit.uz',
            'password' => Hash::make('mudir123'),
        ]);
//        DB::table('users')->insert([
//            'name' => "Super Admin",
//            'email' => 'super@ubtuit.uz',
//            'password' => Hash::make('super123'),
//        ]);
    }
}
