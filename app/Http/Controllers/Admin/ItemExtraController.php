<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\ItemExtras\GetPaginatedItemExtras;
use App\Actions\Contracts\ItemExtras\SoftDeleteItemExtra;
use App\Actions\Contracts\ItemExtras\StoreItemExtra;
use App\Actions\Contracts\ItemExtras\UpdateItemExtra;
use App\Actions\Contracts\Menus\GetMenus;
use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemExtras\StoreItemExtraRequest;
use App\Http\Requests\ItemExtras\UpdateItemExtraRequest;
use App\Models\ItemExtra;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemExtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_restaurant_owner')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param GetPaginatedItemExtras $getPaginatedItemExtras
     * @return View
     */
    public function index(GetPaginatedItemExtras $getPaginatedItemExtras): View
    {
        $itemExtras = $getPaginatedItemExtras->handle();
        return view('admin.item_extras.index', ['rows' => $itemExtras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetRestaurants $getRestaurants
     * @param GetMenus $getMenus
     * @return View
     */
    public function create(GetRestaurants $getRestaurants, GetMenus $getMenus): View
    {
        if (auth()->user()->can('general-all') && !session()->has('restaurant')) {
            $data['restaurants'] = $getRestaurants->handle()->pluck('name', 'id');
        }
        else {
            $data['menus'] = $getMenus->handle()->pluck('name', 'id');
        }

        return view('admin.item_extras.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItemExtraRequest $storeItemExtraRequest
     * @param StoreItemExtra $storeItemExtra
     * @return RedirectResponse
     */
    public function store(StoreItemExtraRequest $storeItemExtraRequest, StoreItemExtra $storeItemExtra): RedirectResponse
    {
        $data = $storeItemExtraRequest->validated();
        $storeItemExtra->handle($data);

        return redirect()->route('admin.item-extras.index')
            ->with(
                'success',
                'The item extra has been created successfully.'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemExtra  $itemExtra
     * @return \Illuminate\Http\Response
     */
    public function show(ItemExtra $itemExtra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ItemExtra $itemExtra
     * @return View
     */
    public function edit(ItemExtra $itemExtra): View
    {
        $itemExtra->load(['item', 'item.menu', 'item.menu.restaurant']);
        return view('admin.item_extras.edit', ['row' => $itemExtra]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemExtraRequest $updateItemExtraRequest
     * @param UpdateItemExtra $updateItemExtra
     * @param ItemExtra $itemExtra
     * @return RedirectResponse
     */
    public function update(
        UpdateItemExtraRequest $updateItemExtraRequest,
        UpdateItemExtra $updateItemExtra,
        ItemExtra $itemExtra
    ): RedirectResponse
    {
        $data = $updateItemExtraRequest->validated();
        $updateItemExtra->handle($itemExtra, $data);

        return redirect()->route('admin.item-extras.index')
            ->with(
                'success',
                'The item extra has been updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SoftDeleteItemExtra $softDeleteItemExtra
     * @param ItemExtra $itemExtra
     * @return RedirectResponse
     */
    public function destroy(SoftDeleteItemExtra $softDeleteItemExtra, ItemExtra $itemExtra): RedirectResponse
    {
        $softDeleteItemExtra->handle($itemExtra);
        return redirect()->route('admin.item-extras.index')
            ->with(
                'success',
                'The item extra has been soft deleted successfully.'
            );
    }
}
