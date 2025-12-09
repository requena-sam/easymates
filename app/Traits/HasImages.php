<?php

namespace App\Traits;

use App\Services\ImageService;

trait HasImages
{
    public function handleImageUpload($file)
    {
        return app(ImageService::class)->storeResponsiveImage($file);
    }
}
