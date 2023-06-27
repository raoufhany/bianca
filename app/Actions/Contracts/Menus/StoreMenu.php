<?php

namespace App\Actions\Contracts\Menus;

use App\Actions\Contracts\ItemExtras\StoreItemExtra;
use App\Actions\Contracts\Items\StoreItem;
use App\Models\Menu;

interface StoreMenu
{
    public function handle(array $data): Menu;
}
