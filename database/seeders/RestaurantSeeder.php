<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Restaurant::query()->create([
            'name' => 'Bianca',
            'address' => fake()->address(),
            'phone_number' => fake()->phoneNumber(),
            'user_id' => User::query()
                ->where('email', 'owner@bianca.com')
                ->first()
                ->getOriginal('id'),
        ]);

//        Restaurant::query()->create([
//            'name' => fake()->name(),
//            'address' => fake()->address(),
//            'phone_number' => fake()->phoneNumber(),
//            'user_id' => User::query()
//                ->where('email', 'empty@restaurant.com')
//                ->first()
//                ->getOriginal('id'),
//        ]);
    }
}
