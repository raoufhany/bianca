<?php

namespace App\Actions\Menus;

use App\Actions\Contracts\Menus\ChangeMenuStatus;
use App\Enums\Status;
use App\Models\Menu;

class ChangeMenuStatusAction implements ChangeMenuStatus
{
    public function handle(Menu $menu): void
    {
        if (!$menu->status->is(Status::Visible)) {
            Menu::where('status', Status::Visible)->update(['status' => Status::Invisible]);
            $menu->update(['status' => Status::Visible]);
        }
    }
}
