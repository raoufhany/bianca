<?php

namespace App\Providers;

use App\Actions\Categories\GetCategoriesAction;
use App\Actions\Categories\GetCategoryPositionsAction;
use App\Actions\Categories\GetPaginatedCategoriesAction;
use App\Actions\Categories\SoftDeleteCategoryAction;
use App\Actions\Categories\StoreCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Actions\Contracts\Categories\GetCategories;
use App\Actions\Contracts\Categories\GetCategoryPositions;
use App\Actions\Contracts\Categories\GetPaginatedCategories;
use App\Actions\Contracts\Categories\SoftDeleteCategory;
use App\Actions\Contracts\Categories\StoreCategory;
use App\Actions\Contracts\Categories\UpdateCategory;
use App\Actions\Contracts\Extras\GetExtras;
use App\Actions\Contracts\ItemExtras\GetPaginatedItemExtras;
use App\Actions\Contracts\ItemExtras\SoftDeleteItemExtra;
use App\Actions\Contracts\ItemExtras\StoreItemExtra;
use App\Actions\Contracts\ItemExtras\UpdateItemExtra;
use App\Actions\Contracts\Items\GetItems;
use App\Actions\Contracts\Items\GetPaginatedItems;
use App\Actions\Contracts\Items\SoftDeleteItem;
use App\Actions\Contracts\Items\StoreItem;
use App\Actions\Contracts\Items\UpdateItem;
use App\Actions\Contracts\Menus\ChangeMenuStatus;
use App\Actions\Contracts\Menus\GetMenus;
use App\Actions\Contracts\Menus\SoftDeleteMenu;
use App\Actions\Contracts\Menus\GetPaginatedMenus;
use App\Actions\Contracts\Menus\StoreMenu;
use App\Actions\Contracts\Menus\UpdateMenu;
use App\Actions\Contracts\Restaurants\GetRestaurants;
use App\Actions\Contracts\Tables\GetPaginatedTables;
use App\Actions\Contracts\Tables\SoftDeleteTable;
use App\Actions\Contracts\Tables\StoreTable;
use App\Actions\Contracts\Tables\UpdateTable;
use App\Actions\Extras\GetExtrasAction;
use App\Actions\ItemExtras\GetPaginatedItemExtrasAction;
use App\Actions\ItemExtras\SoftDeleteItemExtraAction;
use App\Actions\ItemExtras\StoreItemExtraAction;
use App\Actions\ItemExtras\UpdateItemExtraAction;
use App\Actions\Items\GetItemsAction;
use App\Actions\Items\GetPaginatedItemsAction;
use App\Actions\Items\SoftDeleteItemAction;
use App\Actions\Items\StoreItemAction;
use App\Actions\Items\UpdateItemAction;
use App\Actions\Menus\ChangeMenuStatusAction;
use App\Actions\Menus\GetMenusAction;
use App\Actions\Menus\SoftDeleteMenuAction;
use App\Actions\Menus\GetPaginatedMenusAction;
use App\Actions\Menus\StoreMenuAction;
use App\Actions\Menus\UpdateMenuAction;
use App\Actions\Restaurants\GetRestaurantsAction;
use App\Actions\Tables\GetPaginatedTablesAction;
use App\Actions\Tables\SoftDeleteTableAction;
use App\Actions\Tables\StoreTableAction;
use App\Actions\Tables\UpdateTableAction;
use Illuminate\Support\ServiceProvider;

class ActionServiceProvider extends ServiceProvider
{
    public array $customBindings = [];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
//        $contractPrefix = 'App\\Actions\\Contracts';
//        $actionPrefix = 'App\\Actions';
//        $actionSuffix = 'Action';
//
//        foreach (get_declared_interfaces() as $contract) {
//            if (str_starts_with($contract, $contractPrefix)) {
//                $action = $actionPrefix.explode('Contracts', $contract)[1].$actionSuffix;
//
//                $this->app->bind($contract, $this->customBindings[$contract] ?? $action);
//            }
//        }

        //Restaurant
        $this->app->bind(GetRestaurants::class, GetRestaurantsAction::class);

        //Menus
        $this->app->bind(GetMenus::class, GetMenusAction::class);
        $this->app->bind(StoreMenu::class, StoreMenuAction::class);
        $this->app->bind(UpdateMenu::class, UpdateMenuAction::class);
        $this->app->bind(SoftDeleteMenu::class, SoftDeleteMenuAction::class);
        $this->app->bind(ChangeMenuStatus::class, ChangeMenuStatusAction::class);
        $this->app->bind(GetPaginatedMenus::class, GetPaginatedMenusAction::class);

        //Categories
        $this->app->bind(GetCategories::class, GetCategoriesAction::class);
        $this->app->bind(StoreCategory::class, StoreCategoryAction::class);
        $this->app->bind(UpdateCategory::class, UpdateCategoryAction::class);
        $this->app->bind(SoftDeleteCategory::class, SoftDeleteCategoryAction::class);
        $this->app->bind(GetCategoryPositions::class, GetCategoryPositionsAction::class);
        $this->app->bind(GetPaginatedCategories::class, GetPaginatedCategoriesAction::class);

        //Items
        $this->app->bind(GetItems::class, GetItemsAction::class);
        $this->app->bind(StoreItem::class, StoreItemAction::class);
        $this->app->bind(UpdateItem::class, UpdateItemAction::class);
        $this->app->bind(SoftDeleteItem::class, SoftDeleteItemAction::class);
        $this->app->bind(GetPaginatedItems::class, GetPaginatedItemsAction::class);

        //Item extras
        $this->app->bind(StoreItemExtra::class, StoreItemExtraAction::class);
        $this->app->bind(UpdateItemExtra::class, UpdateItemExtraAction::class);
        $this->app->bind(SoftDeleteItemExtra::class, SoftDeleteItemExtraAction::class);
        $this->app->bind(GetPaginatedItemExtras::class, GetPaginatedItemExtrasAction::class);

        //Tables
        $this->app->bind(StoreTable::class, StoreTableAction::class);
        $this->app->bind(UpdateTable::class, UpdateTableAction::class);
        $this->app->bind(SoftDeleteTable::class, SoftDeleteTableAction::class);
        $this->app->bind(GetPaginatedTables::class, GetPaginatedTablesAction::class);

        //Extras
        $this->app->bind(GetExtras::class, GetExtrasAction::class);
    }
}
