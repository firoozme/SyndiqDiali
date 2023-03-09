<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  Admin
         User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'), // visepresident
            'email' => 'admin@gmail.com',
            'phone' => '1111111',
        ]);
    }
}
