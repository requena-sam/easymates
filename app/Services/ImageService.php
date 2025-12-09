<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function storeResponsiveImage($file)
    {
        $uuid = Str::uuid()->toString();
        $folder = "uploads/$uuid";
        Storage::disk('public')->makeDirectory($folder);

        $img = $this->manager->read($file->getRealPath());

        $sizes = [
            'small' => 600,
            'medium' => 1400,
            'large' => 2400,
        ];

        $paths = [];

        foreach ($sizes as $sizeName => $width) {
            $resized = clone $img;

            $originalWidth = $img->width();

            if ($originalWidth > $width) {
                $resized->scale(width: $width);
            }

            $filename = "$sizeName.webp";
            $path = "$folder/$filename";

            $encoded = $resized->toWebp(quality: 99);

            Storage::disk('public')->put($path, $encoded, 'public');

            $paths[$sizeName] = "storage/$path";
        }

        return [
            'folder' => $folder,
            'sizes' => $paths,
            'original' => $paths['large'],
        ];
    }

    public function deleteResponsiveImages($folder)
    {
        if ($folder && Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->deleteDirectory($folder);
        }
    }
}
