<?php

namespace App\Actions\Contracts\Restaurants;

use Illuminate\Database\Eloquent\Builder;

interface GetRestaurants
{
    public function handle(): Builder;
}
