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
}
?>