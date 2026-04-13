<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin Principal',
            'email'    => 'admin@arbitrage.ma',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Arbitres (10)
        $arbitres = [
            ['name' => 'Youssef Alami',     'email' => 'youssef.alami@arbitrage.ma'],
            ['name' => 'Khalid Benali',     'email' => 'khalid.benali@arbitrage.ma'],
            ['name' => 'Hassan Idrissi',    'email' => 'hassan.idrissi@arbitrage.ma'],
            ['name' => 'Omar Fassi',        'email' => 'omar.fassi@arbitrage.ma'],
            ['name' => 'Rachid Tazi',       'email' => 'rachid.tazi@arbitrage.ma'],
            ['name' => 'Mehdi Chraibi',     'email' => 'mehdi.chraibi@arbitrage.ma'],
            ['name' => 'Amine Kettani',     'email' => 'amine.kettani@arbitrage.ma'],
            ['name' => 'Saad Berrada',      'email' => 'saad.berrada@arbitrage.ma'],
            ['name' => 'Nabil Ziani',       'email' => 'nabil.ziani@arbitrage.ma'],
            ['name' => 'Karim Mansouri',    'email' => 'karim.mansouri@arbitrage.ma'],
        ];

        foreach ($arbitres as $arbitre) {
            User::create([
                'name'     => $arbitre['name'],
                'email'    => $arbitre['email'],
                'password' => Hash::make('password'),
                'role'     => 'arbitre',
            ]);
        }
    }
}