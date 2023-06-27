<?php

namespace App\Actions\Restaurants;

use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Builder;

class GetRestaurantsAction implements GetRestaurants
{
    public function handle(): Builder
    {
        return Restaurant::query();
    }
}
