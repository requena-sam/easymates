<?php

namespace App\Livewire\Creations;

use App\Enums\PostTags;
use App\Models\Creation;
use App\Traits\HasImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages;

    public $title;
    public $description;
    public $image;
    public $tags = [];
    public $searchTag = '';

    protected $listeners = ['modalClosed' => 'resetForm'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048'
    ];

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
            $this->dispatch('notifyAlert', message: 'Création publiée avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création: ' . $e->getMessage());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
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
