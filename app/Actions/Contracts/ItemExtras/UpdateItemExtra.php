<?php

namespace App\Actions\Contracts\ItemExtras;

use App\Models\ItemExtra;

interface UpdateItemExtra
{
    public function handle(ItemExtra $itemExtra, array $data): void;
}
