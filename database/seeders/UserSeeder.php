<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Omar',
            'email' => 'admin@split.com',
            'password' => 'omar@1234',
            'phone_number' => '01021478596',
        ]);

        $user->assignRole('Super Admin');


        $restaurantOwner = User::query()->create([
            'name' => 'Owner Test',
            'email' => 'owner@restaurant.com',
            'password' => 'owner@1234',
            'phone_number' => '01121478596',
        ]);

        $restaurantOwner->assignRole('Restaurant Owner');

        $restaurantEmpty = User::query()->create([
            'name' => 'Restaurant Test',
            'email' => 'empty@restaurant.com',
            'password' => 'empty@1234',
            'phone_number' => '01121478597',
        ]);

        $restaurantEmpty->assignRole('Restaurant Owner');
    }
}
