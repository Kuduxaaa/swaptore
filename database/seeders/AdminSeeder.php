<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'nikakuduxashvili0@gmail.com')->first();

        if (!$user) 
        {
            User::create([
                'email' => 'nikakuduxashvili0@gmail.com',
                'first_name' => 'Nika',
                'last_name' => 'Kudukhashvili',
                'phone_number' => '+995574058565',
                'refferal_code' => null,
                'password' => ('30zx40c40pl'),
                'role' => 2
            ]);
        }
    }
}
