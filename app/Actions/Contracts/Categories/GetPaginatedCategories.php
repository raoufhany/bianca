<?php

namespace App\Actions\Contracts\Categories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedCategories
{
    public function handle(): LengthAwarePaginator;
}
