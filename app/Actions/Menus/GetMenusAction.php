<?php

namespace App\Actions\Menus;

use App\Models\Menu;
use App\Actions\Contracts\Menus\GetMenus;
use Illuminate\Database\Eloquent\Builder;

class GetMenusAction implements GetMenus
{
    public function handle(): Builder
    {
        return Menu::query()->when(session('restaurant') !== null, function ($query) {
            $query->where('restaurant_id', session('restaurant.id'));
        });
    }
}
