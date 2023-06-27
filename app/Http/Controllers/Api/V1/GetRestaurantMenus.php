<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Contracts\Menus\GetMenus;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetRestaurantMenus extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param GetMenus $getMenus
     * @return JsonResponse
     */
    public function __invoke(Request $request, GetMenus $getMenus): JsonResponse
    {
        $restaurantId = $request->input('id');
        $menus = $getMenus->handle()
            ->where('restaurant_id', $restaurantId)
            ->pluck('name', 'id');
        return response()->json($menus);
    }
}
