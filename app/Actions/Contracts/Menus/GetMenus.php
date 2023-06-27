<?php

namespace App\Actions\Contracts\Menus;

use Illuminate\Database\Eloquent\Builder;

interface GetMenus
{
    public function handle(): Builder;
}
