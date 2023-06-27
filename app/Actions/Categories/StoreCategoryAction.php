<?php

namespace App\Actions\Categories;

use App\Actions\Contracts\Categories\StoreCategory;
use App\Actions\Contracts\Items\StoreItem;
use App\Models\Category;
use App\Support\Image;

class StoreCategoryAction implements StoreCategory
{
    /**
     * @param StoreItem $storeItem
     */
    public function __construct(public StoreItem $storeItem)
    {
    }

    public function handle(array $data): Category
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/categories/';
            $data['image'] = Image::store($data['image'], $filePath);
        }

        $category = Category::create($data);

        if (isset($data['item_name']) && !empty($data['item_name'])) {
            foreach ($data['item_name'] as $itemKey => $itemName) {

                $itemData = [
                    'name' => $itemName,
                    'image' => $data['item_image'][$itemKey] ?? null,
                    'description' => $data['item_description'][$itemKey],
                    'price' => $data['item_price'][$itemKey],
                    'category_id' => $category->id,
                ];

                $item = $this->storeItem->handle($itemData);

                if (isset($data['item_extra']) && !empty($data['item_extra'])) {
                    $item->itemExtras()->attach($data['item_extra'][$itemKey]);
                }

//                if (isset($data['item_extra_name'][$itemKey]) && !empty($data['item_extra_name'][$itemKey])) {
//                    foreach ($data['item_extra_name'][$itemKey] as $itemExtraKey => $itemExtraName) {
//                        $itemExtraData = [
//                            'name' => $itemExtraName,
//                            'image' => $data['item_extra_image'][$itemKey][$itemExtraKey],
//                            'description' => $data['item_extra_description'][$itemKey][$itemExtraKey],
//                            'price' => $data['item_extra_price'][$itemKey][$itemExtraKey],
//                            'item_id' => $item->id,
//                        ];
//
//                        $itemExtra = $this->storeItemExtra->handle($itemExtraData);
//                    }
//                }
            }
        }

        return $category;
    }
}
