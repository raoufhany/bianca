<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Contracts\Items\GetItems;
use App\Actions\Contracts\Menus\GetMenus;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetMenuItems extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param GetItems $getItems
     * @return JsonResponse
     */
    public function __invoke(Request $request, GetItems $getItems): JsonResponse
    {
        $menuId = $request->input('id');
        $items = $getItems->handle()
            ->where('menu_id', $menuId)
            ->pluck('name', 'id');
        return response()->json($items);
    }
}
