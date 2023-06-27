<?php

namespace App\Actions\Menus;

use App\Actions\Contracts\Menus\StoreMenu;
use App\Enums\Status;
use App\Models\Menu;
use App\Support\Image;

class StoreMenuAction implements StoreMenu
{
    public function handle(array $data): Menu
    {
        $data['status'] = Menu::query()->where('status', Status::Visible)->count() == 1 ?
            Status::Invisible :
            Status::Visible;

        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/menus/';
            $data['image'] = Image::store($data['image'], $filePath);
        }

        return Menu::create($data);
    }
}
