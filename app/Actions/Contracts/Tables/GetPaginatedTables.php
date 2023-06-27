<?php

namespace App\Actions\Contracts\Tables;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface GetPaginatedTables
{
    public function handle(): LengthAwarePaginator;
}
