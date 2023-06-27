<?php

namespace App\Actions\ItemExtras;

use App\Actions\Contracts\ItemExtras\UpdateItemExtra;
use App\Models\ItemExtra;
use App\Support\Image;

class UpdateItemExtraAction implements UpdateItemExtra
{
    public function handle(ItemExtra $itemExtra, array $data): void
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/item_extras/';
            $data['image'] = Image::update($itemExtra->image, $data['image'], $filePath);
        }

        $itemExtra->update($data);
    }
}
