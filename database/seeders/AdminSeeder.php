<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name'     => 'admin1',
                'email'    => 'admin1@shop.com',
                'password' => Hash::make('password123'),
                'shop_id'  => 'shop_1',
            ],
            [
                'name'     => 'admin2',
                'email'    => 'admin2@shop.com',
                'password' => Hash::make('password123'),
                'shop_id'  => 'shop_2',
            ],
            [
                'name'     => 'admin3',
                'email'    => 'admin3@shop.com',
                'password' => Hash::make('password123'),
                'shop_id'  => 'shop_3',
            ],
            [
                'name'     => 'admin4',
                'email'    => 'admin4@shop.com',
                'password' => Hash::make('password123'),
                'shop_id'  => 'shop_4',
            ],
        ];

        foreach ($admins as $admin) {
            Admin::create($admin);
        }
    }
}