<?php

namespace App\Actions\ItemExtras;

use App\Actions\Contracts\ItemExtras\SoftDeleteItemExtra;
use App\Models\ItemExtra;

class SoftDeleteItemExtraAction implements SoftDeleteItemExtra
{
    public function handle(ItemExtra $itemExtra): void
    {
        $itemExtra->delete();
    }
}
