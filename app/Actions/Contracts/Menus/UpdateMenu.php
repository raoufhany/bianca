<?php

namespace App\Actions\Contracts\Menus;

use App\Models\Menu;

interface UpdateMenu
{
    public function handle(Menu $menu, array $data): void;
}
