<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'surname' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'Admin',
            'password' => Hash::make('Admin@123'),
            'role' => 'Admin',
        ]);
    }
}
