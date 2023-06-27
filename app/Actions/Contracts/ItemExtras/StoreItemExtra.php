<?php

namespace App\Actions\Contracts\ItemExtras;

use App\Models\ItemExtra;

interface StoreItemExtra
{
    public function handle(array $data): ItemExtra;
}
