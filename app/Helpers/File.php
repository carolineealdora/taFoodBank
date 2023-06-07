<?php
namespace App\Helpers;

use App\Models\Donatur;
use App\Models\NGO;
use Illuminate\Support\Facades\Storage;

class File{
    public static function fileUpload($requestFile, $path)
    {
        $path = Storage::disk('public')->put(
            $path,
            $requestFile
        );

        return $path;
    }

    public static function delete($path)
    {
        // Storage::delete('public/storage/' . $path);
        Storage::disk('public')->delete($path);

        return 1;
    }
}
?>
