<?php

namespace App\Actions\ItemExtras;

use App\Actions\Contracts\ItemExtras\GetPaginatedItemExtras;
use App\Models\ItemExtra;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetPaginatedItemExtrasAction implements GetPaginatedItemExtras
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): LengthAwarePaginator
    {
        return ItemExtra::query()
            ->when(session('restaurant') !== null, function ($query) {
                $query->whereHas('item', function ($subQuery) {
                    $subQuery->whereHas('menu', function ($q) {
                        $q->where('restaurant_id', session('restaurant.id'));
                    });
                });
            })
            ->when(request()->has('name'), function ($query) {
                $query->where('name', 'LIKE', '%'. request()->get('name') .'%');
            })
            ->with(['item', 'item.menu', 'item.menu.restaurant'])
            ->paginate()
            ->withQueryString();
    }
}
