<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Menus\GetMenus;
use App\Actions\Contracts\Menus\SoftDeleteMenu;
use App\Actions\Contracts\Menus\GetPaginatedMenus;
use App\Actions\Contracts\Menus\StoreMenu;
use App\Actions\Contracts\Menus\UpdateMenu;
use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menus\StoreMenuRequest;
use App\Http\Requests\Menus\UpdateMenuRequest;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_restaurant_owner')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param GetPaginatedMenus $getPaginatedMenus
     * @return View
     */
    public function index(GetPaginatedMenus $getPaginatedMenus): View
    {
        $menus = $getPaginatedMenus->handle();
        return view('admin.menus.index', ['rows' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetRestaurants $getRestaurants
     * @return View
     */
    public function create(GetRestaurants $getRestaurants): View
    {
        if (session()->has('restaurant')) {
            $restaurants = [session('restaurant.id') => session('restaurant.name')];
        }
        else {
            $restaurants = $getRestaurants->handle()->pluck('name', 'id');
        }

        return view('admin.menus.create', [
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMenuRequest $storeMenuRequest
     * @param StoreMenu $storeMenu
     * @return RedirectResponse
     */
    public function store(StoreMenuRequest $storeMenuRequest, StoreMenu $storeMenu): RedirectResponse
    {
        $menu = $storeMenu->handle($storeMenuRequest->validated());

        return redirect()->route('admin.menus.index')
            ->with(
                'success',
                'The menu has been created successfully.'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param Menu $menu
     * @return View
     */
    public function show(Menu $menu, GetMenus $getMenus): View
    {
        $menu->load(['categories', 'categories.items']);

        return view('admin.menus.show', [
            'row' => $menu,
            'menus' => $getMenus->handle()->pluck('name', 'id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Menu $menu
     * @param GetRestaurants $getRestaurants
     * @return View
     */
    public function edit(Menu $menu, GetRestaurants $getRestaurants): View
    {
        $menu->load('restaurant');

        if (session()->has('restaurant')) {
            $restaurants = [session('restaurant.id') => session('restaurant.name')];
        }
        else {
            $restaurants = $getRestaurants->handle()->pluck('name', 'id');
        }

        return view('admin.menus.edit', [
            'row' => $menu,
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMenuRequest $updateMenuRequest
     * @param UpdateMenu $updateMenu
     * @param Menu $menu
     * @return RedirectResponse
     */
    public function update(
        UpdateMenuRequest $updateMenuRequest,
        UpdateMenu $updateMenu,
        Menu $menu
    ): RedirectResponse
    {
        $data = $updateMenuRequest->validated();
        $updateMenu->handle($menu, $data);

        return redirect()->route('admin.menus.index')
            ->with(
                'success',
                'The menu has been updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Menu $menu
     * @param SoftDeleteMenu $deleteMenu
     * @return RedirectResponse
     */
    public function destroy(Menu $menu, SoftDeleteMenu $deleteMenu): RedirectResponse
    {
        $deleteMenu->handle($menu);
        return redirect()->route('admin.menus.index')
            ->with(
                'success',
                'The menu has been soft deleted successfully.'
            );
    }
}
