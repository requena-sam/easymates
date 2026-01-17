<?php

namespace App\Traits;

use App\Services\ImageService;

trait HasImages
{
    /**
     * Upload une seule image
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string UUID
     */
    protected function uploadImage($file): string
    {
        return app(ImageService::class)->store($file);
    }

    /**
     * Upload plusieurs images
     *
     * @param array $files
     * @return array UUIDs
     */
    protected function uploadImages(array $files): array
    {
        return app(ImageService::class)->storeMultiple($files);
    }

    /**
     * Supprimer une image
     *
     * @param string $uuid
     * @return bool
     */
    protected function deleteImage(string $uuid): bool
    {
        return app(ImageService::class)->delete($uuid);
    }

    /**
     * Supprimer plusieurs images
     *
     * @param array $uuids
     * @return void
     */
    protected function deleteImages(array $uuids): void
    {
        app(ImageService::class)->deleteMultiple($uuids);
    }
}
