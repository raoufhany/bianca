<?php

namespace App\Actions\Contracts\ItemExtras;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedItemExtras
{
    public function handle(): LengthAwarePaginator;
}
