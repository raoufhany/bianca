<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Contracts\Categories\GetCategoryPositions;
use App\Actions\Contracts\Categories\GetPaginatedCategories;
use App\Actions\Contracts\Categories\SoftDeleteCategory;
use App\Actions\Contracts\Categories\StoreCategory;
use App\Actions\Contracts\Categories\UpdateCategory;
use App\Actions\Contracts\Extras\GetExtras;
use App\Actions\Contracts\Menus\GetMenus;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_restaurant_owner')->only(['create', 'store', 'edit', 'update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param GetPaginatedCategories $getPaginatedCategories
     * @return View
     */
    public function index(GetPaginatedCategories $getPaginatedCategories): View
    {
        $categories = $getPaginatedCategories->handle();
        return view('admin.categories.index', ['rows' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetMenus $getMenus
     * @param GetExtras $getExtras
     * @return View
     */
    public function create(GetMenus $getMenus, GetExtras $getExtras): View
    {
        $menus = $getMenus->handle()->pluck('name', 'id');
        $extras = $getExtras->handle()->pluck('name', 'id');

        return view('admin.categories.create', [
            'menus' => $menus,
            'extras' => $extras,
            'statuses' => Status::asSelectArray(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCategoryRequest $storeCategoryRequest
     * @param StoreCategory $storeCategory
     * @return RedirectResponse
     */
    public function store(StoreCategoryRequest $storeCategoryRequest, StoreCategory $storeCategory): RedirectResponse
    {
        return DB::transaction(function () use ($storeCategoryRequest, $storeCategory) {
            $menu = $storeCategory->handle($storeCategoryRequest->validated());

            return redirect()->route('admin.categories.index')
                ->with(
                    'success',
                    'The category has been created successfully.'
                );
        });
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetMenus $getMenus
     * @param GetCategoryPositions $getCategoryPositions
     * @param Category $category
     * @return View
     */
    public function edit(
        GetMenus $getMenus,
        GetCategoryPositions $getCategoryPositions,
        Category $category
    ): View
    {
        $category->load(['menu', 'menu.restaurant']);
        $menus = $getMenus->handle()->pluck('name', 'id');

        return view('admin.categories.edit', [
            'row' => $category,
            'menus' => $menus,
            'statuses' => Status::asSelectArray(),
            'positions' => $getCategoryPositions->handle($category),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoryRequest $updateCategoryRequest
     * @param UpdateCategory $updateCategory
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(
        UpdateCategoryRequest $updateCategoryRequest,
        UpdateCategory $updateCategory,
        Category $category
    ): RedirectResponse
    {
        $data = $updateCategoryRequest->validated();
        $updateCategory->handle($category, $data);

        return redirect()->route('admin.categories.index')
            ->with(
                'success',
                'The category has been updated successfully.'
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param SoftDeleteCategory $deleteCategory
     * @return RedirectResponse
     */
    public function destroy(Category $category, SoftDeleteCategory $deleteCategory): RedirectResponse
    {
        $deleteCategory->handle($category);
        return redirect()->route('admin.categories.index')
            ->with(
                'success',
                'The category has been soft deleted successfully.'
            );
    }
}
