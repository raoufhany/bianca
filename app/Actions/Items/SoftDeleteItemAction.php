<?php

namespace App\Actions\Items;

use App\Actions\Contracts\Items\SoftDeleteItem;
use App\Models\Item;

class SoftDeleteItemAction implements SoftDeleteItem
{
    public function handle(Item $item): void
    {
        $item->delete();
    }
}
