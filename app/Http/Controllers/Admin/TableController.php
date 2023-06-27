<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Actions\Contracts\Tables\GetPaginatedTables;
use App\Actions\Contracts\Tables\SoftDeleteTable;
use App\Actions\Contracts\Tables\StoreTable;
use App\Actions\Contracts\Tables\UpdateTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tables\StoreTableRequest;
use App\Http\Requests\Tables\UpdateTableRequest;
use App\Models\Table;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_restaurant_owner')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param GetPaginatedTables $getPaginatedTables
     * @return View
     */
    public function index(GetPaginatedTables $getPaginatedTables): View
    {
        $tables = $getPaginatedTables->handle();
        return view('admin.tables.index', ['rows' => $tables]);
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

        return view('admin.tables.create', ['restaurants' => $restaurants]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTableRequest $storeTableRequest
     * @param StoreTable $storeTable
     * @return RedirectResponse
     */
    public function store(StoreTableRequest $storeTableRequest, StoreTable $storeTable): RedirectResponse
    {
        $data = $storeTableRequest->validated();
        $storeTable->handle($data);

        return redirect()->route('admin.tables.index')
            ->with(
                'success',
                'The table has been created successfully.'
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Table $table
     * @param GetRestaurants $getRestaurants
     * @return View
     */
    public function edit(Table $table, GetRestaurants $getRestaurants): View
    {
        if (session()->has('restaurant')) {
            $restaurants = [session('restaurant.id') => session('restaurant.name')];
        }
        else {
            $restaurants = $getRestaurants->handle()->pluck('name', 'id');
        }

        return view('admin.tables.edit', [
            'row' => $table,
            'restaurants' => $restaurants
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTableRequest $updateTableRequest
     * @param UpdateTable $updateTable
     * @param Table $table
     * @return RedirectResponse
     */
    public function update(
        UpdateTableRequest $updateTableRequest,
        UpdateTable $updateTable,
        Table $table
    ): RedirectResponse
    {
        $data = $updateTableRequest->validated();
        $updateTable->handle($table, $data);

        return redirect()->route('admin.tables.index')
            ->with(
                'success',
                'The table has been updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Table $table
     * @param SoftDeleteTable $softDeleteTable
     * @return RedirectResponse
     */
    public function destroy(Table $table, SoftDeleteTable $softDeleteTable): RedirectResponse
    {
        $softDeleteTable->handle($table);
        return redirect()->route('admin.tables.index')
            ->with(
                'success',
                'The table has been soft deleted successfully.'
            );
    }
}
