<?php

namespace App\Actions\Contracts\Items;

use Illuminate\Database\Eloquent\Builder;

interface GetItems
{
    public function handle(): Builder;
}
