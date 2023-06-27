<?php

namespace App\Actions\Tables;

use App\Actions\Contracts\Tables\UpdateTable;
use App\Models\Table;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UpdateTableAction implements UpdateTable
{
    public function handle(Table $table, array $data): void
    {
//        // Delete old qr code
//        $filePath = 'images/' . session('restaurant.name') . '/tables/qr_codes/';
//        $image_path = public_path($filePath . $table->qr_code);
//        if (file_exists($image_path)) {
//            File::delete($image_path);
//        }
//
//        $fileName = 'table_'. $data['number'] . '_qrcode_' . time() . rand(0,100) . '.png';
//        QrCode::format('png')
//        ->generate(
//            route('api.v1.restaurant', ['restaurant' => session('restaurant.id'), 'table' => $data['number']]),
//            public_path($filePath . $fileName)
//        );
//
//        $data['qr_code'] = $fileName;

        $table->update($data);
    }
}
