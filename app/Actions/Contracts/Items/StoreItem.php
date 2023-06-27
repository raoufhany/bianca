<?php

namespace App\Actions\Contracts\Items;

use App\Models\Item;

interface StoreItem
{
    public function handle(array $data): Item;
}
