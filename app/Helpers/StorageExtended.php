<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StorageExtended
{
    public static function getDisk()
    {
        return Storage::disk(self::getDiskType());
    }

    public static function getDiskType()
    {
        $cloud = config('filesystems.cloud');
        $default = config('filesystems.default');
        if ($default == "local") {
            return $default;
        } else {
            return $cloud;
        }

    }

    public static function getUrl(?string $path)
    {
        if(StrExtended::isEmpty($path))
        {
            return null;
        }
        $disk = self::getDisk();
        return $disk->url($path);
    }

    public static function storeImage(UploadedFile $image, string $path, string $name = null)
    {
        $disk = self::getDisk();
        if(!isset($name))
        {
            $name = $image->getClientOriginalName( );
        }
        return $disk->put($path.$name, file_get_contents($image->getRealPath()));
    }
}