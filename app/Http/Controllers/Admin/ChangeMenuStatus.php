<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Menus\ChangeMenuStatus as ChangeMenuStatusInterface;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ChangeMenuStatus extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param ChangeMenuStatusInterface $changeMenuStatus
     * @param Menu $menu
     * @return RedirectResponse
     */
    public function __invoke(
        ChangeMenuStatusInterface $changeMenuStatus,
        Menu $menu,
    ): RedirectResponse
    {
        $changeMenuStatus->handle($menu);

        return redirect()->route('admin.menus.index')
            ->with(
                'success',
                'The menu status has been updated successfully.'
            );
    }
}
