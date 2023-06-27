<?php

namespace App\Actions\Contracts\Items;

use App\Models\Item;

interface SoftDeleteItem
{
    public function handle(Item $item): void;
}
