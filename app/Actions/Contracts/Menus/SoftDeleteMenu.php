<?php

namespace App\Actions\Contracts\Menus;

use App\Models\Menu;

interface SoftDeleteMenu
{
    public function handle(Menu $menu): void;
}
