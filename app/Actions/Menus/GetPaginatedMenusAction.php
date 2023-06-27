<?php

namespace App\Actions\Menus;

use App\Models\Menu;
use App\Actions\Contracts\Menus\GetPaginatedMenus;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetPaginatedMenusAction implements GetPaginatedMenus
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): LengthAwarePaginator
    {
        return Menu::query()
            ->when(session('restaurant') !== null, function ($query) {
                $query->where('restaurant_id', session('restaurant.id'));
            })
            ->when(request()->has('name'), function ($query) {
                $query->where('name', 'LIKE', '%'. request()->get('name') .'%');
            })
            ->with('restaurant')
            ->paginate()
            ->withQueryString();
    }
}
