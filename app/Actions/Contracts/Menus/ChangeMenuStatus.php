<?php

namespace App\Actions\Contracts\Menus;

use App\Models\Menu;

interface ChangeMenuStatus
{
    public function handle(Menu $menu): void;
}
