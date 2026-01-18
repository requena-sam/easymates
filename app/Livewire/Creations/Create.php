<?php

namespace App\Livewire\Creations;

use App\Enums\PostTags;
use App\Models\Creation;
use App\Traits\HasImages;
use App\Traits\CreationValidation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages, CreationValidation;

    public $title;
    public $description;
    public $image;
    public $tags = [];
    public $searchTag = '';

    protected $listeners = ['modalClosed' => 'resetForm'];

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function create()
    {
        $this->validate();

        try {
            $imageUuid = $this->uploadImage($this->image);

            Creation::create([
                'title' => $this->title,
                'description' => $this->description,
                'image_uuid' => $imageUuid,
                'tags' => $this->tags,
                'user_id' => auth()->id(),
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('refreshCreationsList');
            $this->sendSuccess('Création publiée avec succès !');
            $this->resetForm();

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue lors de la publication.');
        }
    }

    public function resetForm()
    {
        $this->reset(['title', 'description', 'image', 'tags', 'searchTag']);
        $this->resetValidation();
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

    public function render()
    {
        return view('livewire.creations.create', [
            'filteredTags' => $this->getFilteredTags()
        ]);
    }
}
