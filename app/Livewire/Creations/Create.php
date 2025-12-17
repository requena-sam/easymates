<?php

namespace App\Livewire\Creations;

use App\Enum\PostTags;
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
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:3072'
    ];

    protected $messages = [
        'title.required' => 'Le titre est requis.',
        'title.min' => 'Le titre doit contenir au moins 3 caractères.',
        'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
        'description.required' => 'La description est requise.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'image.required' => 'Une image est requise.',
        'image.image' => 'Le fichier doit être une image valide.',
        'image.max' => 'L\'image ne doit pas dépasser 3 Mo.',
        'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
        'image.dimensions' => 'L\'image doit avoir une taille minimale de 200x200 pixels et maximale de 4096x4096 pixels.',
    ];

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function create()
    {
        $this->validate();

        try {
            $imageData = $this->handleImageUpload($this->image);

            Creation::create([
                'title' => $this->title,
                'description' => $this->description,
                'image_path' => json_encode($imageData),
                'tags' => $this->tags,
                'user_id' => auth()->id(),
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('creationAdded');
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
