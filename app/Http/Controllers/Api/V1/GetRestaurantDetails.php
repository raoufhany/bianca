<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Contracts\Menus\GetMenus;
use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetRestaurantDetails extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Restaurant $restaurant
     * @return RestaurantResource
     */
    public function __invoke(Request $request, Restaurant $restaurant): RestaurantResource
    {
        return new RestaurantResource($restaurant);
    }
}
