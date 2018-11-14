<?php

namespace App\Services;


use Illuminate\Support\Facades\Storage;

class FileServices
{
    public static function checkDrive($product_goods)
    {
        $results = $product_goods->filter(function ($item, $key) {
            return drive($item->complete_machine_product_goods)->isNotEmpty();
        });
        return $results->groupBy([
            function ($item) {
                return $item['jiagou'];
            },
        ], $preserveKeys = true)->sortKeys();
    }

    public static function DriveDelete($drives)
    {
        foreach ($drives as $drive) {
            if (Storage::disk('public')->exists($drive->file['url'])) {
                Storage::disk('public')->delete($drive->file['url']);
                $drive->delete();
            }
        }
    }

    public static function FileDelete($files)
    {
        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file['url_name'])) {
                Storage::disk('public')->delete($file['url_name']);
            }
        }
    }

    public static function copy($files)
    {
        foreach ($files as $file) {
            if (Storage::disk('public')->exists($file['url_name'])) {
                Storage::disk('public')->copy($file['url_name'], 'copy/' . $file['url_name']);
            }
        }
    }
}

?>