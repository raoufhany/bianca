<?php

namespace App\Actions\Tables;

use App\Models\Table;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Actions\Contracts\Tables\StoreTable;

class StoreTableAction implements StoreTable
{
    public function handle(array $data): void
    {
        $table = Table::create($data);

        $filePath = 'images/' . session('restaurant.name') . '/tables/qr_codes/';
        if(!Storage::exists(public_path($filePath))) {
            File::makeDirectory(public_path($filePath), 0777, true, true);
        }

        $fileName = 'table_'. $data['number'] . '_qrcode_' . time() . rand(0,100) . '.png';
        QrCode::format('png')
            ->generate(
                route('api.v1.restaurant', ['restaurant' => session('restaurant.id'), 'table' => $table->id]),
                public_path($filePath . $fileName)
            );

        $table->update(['qr_code' => $fileName]);
    }
}
