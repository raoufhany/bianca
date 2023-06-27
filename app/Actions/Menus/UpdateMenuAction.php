<?php

namespace App\Actions\Menus;

use App\Actions\Contracts\Menus\UpdateMenu;
use App\Models\Menu;
use App\Support\Image;

class UpdateMenuAction implements UpdateMenu
{
    public function handle(Menu $menu, array $data): void
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/menus/';
            $data['image'] = Image::update($menu->image, $data['image'], $filePath);
        }

        $menu->update($data);
    }
}
