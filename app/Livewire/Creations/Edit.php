<?php

namespace App\Livewire\Creations;

use App\Enums\PostTags;
use App\Models\Creation;
use App\Traits\HasImages;
use App\Traits\CreationValidation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, HasImages, CreationValidation;

    public $creationId;
    public $title;
    public $description;
    public $image;
    public $currentImageUuid;
    public $tags = [];
    public $searchTag = '';

    // Override rules pour l'édition (image nullable)
    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'tags' => 'array',
        ];
    }

    public function mount($creationId)
    {
        $this->creationId = $creationId;
        $creation = Creation::findOrFail($creationId);
        $this->title = $creation->title;
        $this->description = $creation->description;
        $this->currentImageUuid = $creation->image_uuid;
        $this->tags = $creation->tags ?? [];
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function getFilteredTags()
    {
        $tags = PostTags::cases();

        if (empty($this->searchTag)) {
            return $tags;
        }

        return array_filter($tags, function ($tag) {
            $label = ucwords(str_replace(['-', '_'], ' ', $tag->value));
            return stripos($label, $this->searchTag) !== false;
        });
    }

    public function update()
    {
        $this->validate();

        $creation = Creation::findOrFail($this->creationId);

        if ($creation->user_id !== auth()->id()) {
            $this->sendError('Vous n\'êtes pas autorisé à modifier cette création.');
            return;
        }

        try {
            $updateData = [
                'title' => $this->title,
                'description' => $this->description,
                'tags' => $this->tags,
            ];

            if ($this->image) {
                if ($creation->image_uuid) {
                    $this->deleteImage($creation->image_uuid);
                }
                $updateData['image_uuid'] = $this->uploadImage($this->image);
            }

            $creation->update($updateData);

            $this->dispatch('closeEditModal');
            $this->dispatch('creationUpdated');
            $this->dispatch('refreshCreationsList');
            $this->sendSuccess('Création mise à jour avec succès!');

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue lors de la modification.');
        }
    }

    public function render()
    {
        return view('livewire.creations.edit', [
            'filteredTags' => $this->getFilteredTags()
        ]);
    }
}
