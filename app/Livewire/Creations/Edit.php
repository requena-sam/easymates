<?php

namespace App\Livewire\Creations;

use App\Enum\PostTags;
use App\Models\Creation;
use Livewire\Component;

class Edit extends Component
{
    public $creationId;
    public $title;
    public $description;
    public $image;
    public $tags = [];
    public $searchTag = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image' => 'required',
        'tags' => 'array',
    ];

    public function mount($creationId)
    {
        $this->creationId = $creationId;
        $creation = Creation::findOrFail($creationId);

        $this->title = $creation->title;
        $this->description = $creation->description;
        $this->image = $creation->image;
        $this->tags = $creation->tags ?? [];
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
            $this->dispatch('notifyAlert', message: 'Vous n\'êtes pas autorisé à modifier cette création.', type: 'error');
            return;
        }

        try {
            $creation->update([
                'title' => $this->title,
                'description' => $this->description,
                'image' => $this->image,
                'tags' => $this->tags,
            ]);

            $this->dispatch('closeEditModal');
            $this->dispatch('creationUpdated');
            $this->dispatch('notifyAlert', message: 'Création mise à jour avec succès!', type: 'success');

        } catch (\Exception $e) {
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la modification.', type: 'error');
        }
    }

    public function render()
    {
        return view('livewire.creations.edit', [
            'filteredTags' => $this->getFilteredTags()
        ]);
    }
}
