<?php

namespace App\Actions\Contracts\ItemExtras;

use App\Models\ItemExtra;

interface SoftDeleteItemExtra
{
    public function handle(ItemExtra $itemExtra): void;
}
