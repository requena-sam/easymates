<?php

namespace App\Traits;

trait ManagesMultipleImages
{
    public array $images = [];
    public array $newImages = [];
    public array $existingImages = [];

    protected function getImageConfig(): array
    {
        return [
            'max_images' => 5,
            'max_size' => 2048,
            'allowed_mimes' => ['jpeg', 'jpg', 'png', 'webp'],
            'validation_rules' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'error_messages' => [
                'max_exceeded' => 'Vous ne pouvez pas télécharger plus de :max images au total.',
                'min_required' => 'Au moins une image est requise.',
            ]
        ];
    }

    public function updatedNewImages()
    {
        $config = $this->getImageConfig();
        $totalImages = $this->getTotalImagesCount() + count($this->newImages);

        if ($totalImages > $config['max_images']) {
            $this->reset('newImages');
            $this->addError('newImages', str_replace(':max', $config['max_images'], $config['error_messages']['max_exceeded']));
            return;
        }

        $validImages = [];
        foreach ($this->newImages as $index => $image) {
            try {
                $this->validateOnly("newImages.{$index}", [
                    "newImages.{$index}" => $config['validation_rules']
                ]);
                $validImages[] = $image;
            } catch (\Illuminate\Validation\ValidationException $e) {
                continue;
            }
        }


        $this->images = array_merge($this->images, $validImages);


        $this->reset('newImages');
    }

    public function removeImage($index)
    {
        array_splice($this->images, $index, 1);
        $this->images = array_values($this->images);
    }

    public function removeExistingImage($index)
    {
        array_splice($this->existingImages, $index, 1);
        $this->existingImages = array_values($this->existingImages);
    }


    public function getTotalImagesCount(): int
    {
        return count($this->existingImages) + count($this->images);
    }

    public function canAddMoreImages(): bool
    {
        return $this->getTotalImagesCount() < $this->getImageConfig()['max_images'];
    }


    protected function validateTotalImages(): bool
    {
        $config = $this->getImageConfig();
        $totalImages = $this->getTotalImagesCount();

        if ($totalImages < 1) {
            $this->addError('images', $config['error_messages']['min_required']);
            return false;
        }

        if ($totalImages > $config['max_images']) {
            $this->addError('images', str_replace(':max', $config['max_images'], $config['error_messages']['max_exceeded']));
            return false;
        }

        return true;
    }


    protected function getAllImageUuids(): array
    {
        $newImageUuids = [];

        if (count($this->images) > 0) {
            $newImageUuids = $this->uploadImages($this->images);
        }

        return array_merge($this->existingImages, $newImageUuids);
    }


    protected function resetImages()
    {
        $this->reset(['images', 'newImages', 'existingImages']);
    }
}
