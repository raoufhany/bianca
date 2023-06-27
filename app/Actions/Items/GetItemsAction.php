<?php

namespace App\Actions\Items;

use App\Models\Item;
use App\Actions\Contracts\Items\GetItems;
use Illuminate\Database\Eloquent\Builder;

class GetItemsAction implements GetItems
{
    public function handle(): Builder
    {
        return Item::query();
    }
}
