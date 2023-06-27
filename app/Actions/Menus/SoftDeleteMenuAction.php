<?php

namespace App\Actions\Menus;

use App\Actions\Contracts\Menus\SoftDeleteMenu;
use App\Models\Menu;

class SoftDeleteMenuAction implements SoftDeleteMenu
{
    public function handle(Menu $menu): void
    {
        $menu->delete();
    }
}
