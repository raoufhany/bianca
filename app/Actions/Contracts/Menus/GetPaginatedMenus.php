<?php

namespace App\Actions\Contracts\Menus;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedMenus
{
    public function handle(): LengthAwarePaginator;
}
