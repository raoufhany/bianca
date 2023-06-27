<?php

namespace App\Actions\Contracts\Items;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedItems
{
    public function handle(): LengthAwarePaginator;
}
