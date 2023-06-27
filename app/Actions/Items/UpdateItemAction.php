<?php

namespace App\Actions\Items;

use App\Actions\Contracts\Items\UpdateItem;
use App\Models\Item;
use App\Support\Image;

class UpdateItemAction implements UpdateItem
{
    public function handle(Item $item, array $data): void
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/items/';
            $data['image'] = Image::update($item->image, $data['image'], $filePath);
        }

        $item->update($data);

        if (isset($data['extra'])) {
            $item->itemExtras()->sync($data['extra']);
        }
    }
}
