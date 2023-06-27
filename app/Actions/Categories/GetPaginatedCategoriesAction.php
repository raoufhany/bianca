<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\GetPaginatedCategories;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetPaginatedCategoriesAction implements GetPaginatedCategories
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): LengthAwarePaginator
    {
        return Category::query()
            ->when(session('restaurant') !== null, function ($query) {
                $query->whereHas('menu', function ($q) {
                    $q->where('restaurant_id', session('restaurant.id'));
                });
            })
            ->when(request()->has('name'), function ($query) {
                $query->where('name', 'LIKE', '%'. request()->get('name') .'%');
            })
            ->with(['menu', 'menu.restaurant'])
            ->orderBy('menu_id')
            ->orderBy('position')
            ->paginate()
            ->withQueryString();
    }
}
