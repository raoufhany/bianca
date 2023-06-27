<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

class Image
{
    public static string $destination = 'images/';

    public static function store($image, $filePath): string
    {
        $name = time() . rand(0,100) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path(self::$destination . $filePath);
        $image->move($destinationPath, $name);

        return $name;
    }

    public static function update($oldImageName, $image, $filePath): string
    {
        self::delete($oldImageName, $filePath);

        return self::store($image, $filePath);
    }

    public static function softDelete($image, $filePath): string
    {
        $name = time() . rand(0,100) . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path(self::$destination . $filePath);
        $image->move($destinationPath, $name);

        return $name;
    }

    public static function delete($imageName, $filePath): void
    {
        $image_path = public_path(self::$destination . $filePath . $imageName);
        if (file_exists($image_path)) {
            File::delete($image_path);
        }
    }
}
