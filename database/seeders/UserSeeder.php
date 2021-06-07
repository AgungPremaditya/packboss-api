<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'schias@gmail.com',
            'name' => 'schias',
            'password' => \Hash::make('12345'),
            'status' => 'active',
            'phone' => 6281234567890,
            'role' => 'admin'
        ]);

        User::create([
            'email' => 'user@gmail.com',
            'name' => 'user',
            'password' => \Hash::make('12345'),
            'status' => 'active',
            'phone' => 6281234567890,
            'role' => 'user'
        ]);

        User::create([
            'email' => 'operator@gmail.com',
            'name' => 'operator',
            'password' => \Hash::make('12345'),
            'status' => 'active',
            'phone' => 6281234567890,
            'role' => 'operator'
        ]);
    }
}
