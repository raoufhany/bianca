<?php

namespace App\Actions\ItemExtras;

use App\Actions\Contracts\ItemExtras\StoreItemExtra;
use App\Models\ItemExtra;
use App\Support\Image;

class StoreItemExtraAction implements StoreItemExtra
{
    public function handle(array $data): ItemExtra
    {
        if (!empty($data['image'])) {
            $filePath =  session('restaurant.name') . '/item_extras/';
            $data['image'] = Image::store($data['image'], $filePath);
        }

        return ItemExtra::create($data);
    }
}
