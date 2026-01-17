<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    protected array $sizes = [
        'small' => 400,
        'medium' => 800,
        'large' => 1200,
    ];

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Store une seule image avec ses variantes
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string UUID de l'image
     */
    public function store($file): string
    {
        $uuid = Str::uuid()->toString();
        $folder = "images/$uuid";

        Storage::disk('public')->makeDirectory($folder);

        $img = $this->manager->read($file->getRealPath());

        $original = $img->toWebp(quality: 95);
        Storage::disk('public')->put("$folder/original.webp", $original);

        foreach ($this->sizes as $sizeName => $width) {
            $resized = clone $img;

            if ($img->width() > $width) {
                $resized->scale(width: $width);
            }

            $encoded = $resized->toWebp(quality: 90);
            Storage::disk('public')->put("$folder/$sizeName.webp", $encoded);
        }

        return $uuid;
    }

    /**
     * Store plusieurs images
     *
     * @param array $files
     * @return array Tableau d'UUIDs
     */
    public function storeMultiple(array $files): array
    {
        $uuids = [];

        foreach ($files as $file) {
            $uuids[] = $this->store($file);
        }

        return $uuids;
    }

    /**
     * Supprimer une image et toutes ses variantes
     *
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool
    {
        $folder = "images/$uuid";

        if (Storage::disk('public')->exists($folder)) {
            return Storage::disk('public')->deleteDirectory($folder);
        }

        return false;
    }

    /**
     * Supprimer plusieurs images
     *
     * @param array $uuids
     * @return void
     */
    public function deleteMultiple(array $uuids): void
    {
        foreach ($uuids as $uuid) {
            $this->delete($uuid);
        }
    }

    /**
     * Obtenir l'URL d'une image avec une taille spécifique
     *
     * @param string $uuid
     * @param string $size (small|medium|large|original)
     * @return string|null
     */
    public function getUrl(string $uuid, string $size = 'medium'): ?string
    {
        $path = "images/$uuid/$size.webp";

        if (Storage::disk('public')->exists($path)) {
            return asset("storage/$path");
        }

        return null;
    }

    /**
     * Obtenir toutes les URLs d'une image
     *
     * @param string $uuid
     * @return array
     */
    public function getAllUrls(string $uuid): array
    {
        $urls = [];

        foreach (array_keys($this->sizes) as $size) {
            $urls[$size] = $this->getUrl($uuid, $size);
        }

        $urls['original'] = $this->getUrl($uuid, 'original');

        return $urls;
    }
}
