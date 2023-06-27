<?php

namespace App\Actions\Items;

use App\Actions\Contracts\Items\StoreItem;
use App\Models\Item;
use App\Support\Image;

class StoreItemAction implements StoreItem
{
    public function handle(array $data): Item
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/items/';
            $data['image'] = Image::store($data['image'], $filePath);
        }

        $item = Item::create($data);

        if (isset($data['extra'])) {
            $item->itemExtras()->attach($data['extra']);
        }

        return $item;
    }
}
