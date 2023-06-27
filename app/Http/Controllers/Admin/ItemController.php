<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Categories\GetCategories;
use App\Actions\Contracts\Extras\GetExtras;
use App\Actions\Contracts\Items\GetPaginatedItems;
use App\Actions\Contracts\Items\SoftDeleteItem;
use App\Actions\Contracts\Items\StoreItem;
use App\Actions\Contracts\Items\UpdateItem;
use App\Actions\Contracts\Menus\GetMenus;
use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_restaurant_owner')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param GetPaginatedItems $getPaginatedItems
     * @return View
     */
    public function index(GetPaginatedItems $getPaginatedItems): View
    {
        $items = $getPaginatedItems->handle();
        return view('admin.items.index', ['rows' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetRestaurants $getRestaurants
     * @param GetCategories $getCategories
     * @param GetExtras $getExtras
     * @return View
     */
    public function create(
        GetRestaurants $getRestaurants,
        GetCategories $getCategories,
        GetExtras $getExtras
    ): View
    {
        if (auth()->user()->can('general-all') && !session()->has('restaurant')) {
            $data['restaurants'] = $getRestaurants->handle()->pluck('name', 'id');
        }
        else {
            $data['categories'] = $getCategories->handle()->pluck('name', 'id');
        }

        $data['statuses'] = Status::asSelectArray();
        $data['extras'] = $getExtras->handle()->pluck('name', 'id');

        return view('admin.items.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItemRequest $storeItemRequest
     * @param StoreItem $storeItem
     * @return RedirectResponse
     */
    public function store(StoreItemRequest $storeItemRequest, StoreItem $storeItem): RedirectResponse
    {
        $data = $storeItemRequest->validated();
        $storeItem->handle($data);

        return redirect()->route('admin.items.index')
            ->with(
                'success',
                'The item has been created successfully.'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return View
     */
    public function edit(
        Item $item,
        GetExtras $getExtras
    ): View
    {
        $item->load('category', 'category.menu', 'category.menu.restaurant', 'itemExtras');

        return view('admin.items.edit', [
            'row' => $item,
            'statuses' => Status::asSelectArray(),
            'extras' => $getExtras->handle()->pluck('name', 'id'),
            'itemExtras' => $item->itemExtras->pluck('id')->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $updateItemRequest
     * @param UpdateItem $updateItem
     * @param Item $item
     * @return RedirectResponse
     */
    public function update(
        UpdateItemRequest $updateItemRequest,
        UpdateItem $updateItem,
        Item $item
    ): RedirectResponse
    {
        $data = $updateItemRequest->validated();
        $updateItem->handle($item, $data);

        return redirect()->route('admin.items.index')
            ->with(
                'success',
                'The item has been updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SoftDeleteItem $softDeleteItem
     * @param Item $item
     * @return RedirectResponse
     */
    public function destroy(SoftDeleteItem $softDeleteItem, Item $item): RedirectResponse
    {
        $softDeleteItem->handle($item);
        return redirect()->route('admin.items.index')
            ->with(
                'success',
                'The item has been soft deleted successfully.'
            );
    }
}
