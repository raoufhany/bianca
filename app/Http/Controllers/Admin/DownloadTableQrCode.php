<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadTableQrCode extends Controller
{
    /**
     * @param Table $table
     * @return BinaryFileResponse
     */
    public function __invoke(Table $table): BinaryFileResponse
    {
        $table->load('restaurant');
        $filepath = public_path('images/' . $table->restaurant->name . '/tables/qr_codes/' . $table->qr_code);

        return response()->download($filepath);
    }
}
