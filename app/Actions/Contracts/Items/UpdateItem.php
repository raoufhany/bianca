<?php

namespace App\Actions\Contracts\Items;

use App\Models\Item;

interface UpdateItem
{
    public function handle(Item $item, array $data): void;
}
