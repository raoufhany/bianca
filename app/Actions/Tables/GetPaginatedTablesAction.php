<?php

namespace App\Actions\Tables;

use App\Models\Table;
use App\Actions\Contracts\Tables\GetPaginatedTables;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class GetPaginatedTablesAction implements GetPaginatedTables
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function handle(): LengthAwarePaginator
    {
        return Table::query()
            ->when(session('restaurant') !== null, function ($query) {
                $query->where('restaurant_id', session('restaurant.id'));
            })
            ->when(request()->has('name'), function ($query) {
                $query->where('number', 'LIKE', '%'. request()->get('name') .'%');
            })
            ->with('restaurant')
            ->paginate()
            ->withQueryString();
    }
}
