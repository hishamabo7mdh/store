<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'firas',
            'email' => 'f@gmail.com',
            'password' =>Hash::make('password'),
            'phoneNumber'=>'9876787',

        ]);

        DB::table('users')->insert([
            'name' => 'khalid',
            'email' => 'k@gmail.com',
            'password' =>Hash::make('password'),
            'phoneNumber'=>'9816787',

        ]);

    }
}
