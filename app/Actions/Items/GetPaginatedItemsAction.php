<?php

namespace App\Actions\Items;

use App\Actions\Contracts\Items\GetPaginatedItems;
use App\Models\Item;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetPaginatedItemsAction implements GetPaginatedItems
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): LengthAwarePaginator
    {
        return Item::query()
            ->when(session('restaurant') !== null, function ($query) {
                $query->whereHas('category.menu', function ($q) {
                    $q->where('restaurant_id', session('restaurant.id'));
                });
            })
            ->when(request()->has('name'), function ($query) {
                $query->where('name', 'LIKE', '%'. request()->get('name') .'%');
            })
            ->with(['category', 'category.menu', 'category.menu.restaurant'])
            ->paginate()
            ->withQueryString();
    }
}
