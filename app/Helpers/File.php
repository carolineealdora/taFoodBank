<?php 
namespace App\Helpers;

use App\Models\NGO;
use Illuminate\Support\Facades\Storage;

class File{
    public static function fileUpload($requestFile, $path, $id)
    {
        $path = Storage::disk('public')->put(
            $path,
            $requestFile
        );

        $dataFile = [
            'pic_foto' => $path,
        ];

        $file = NGO::Find($id)->update($dataFile);

        return $file;
    }
}
?>