<?php

namespace App\Livewire\Creations;

use App\Models\Creation;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CreationsList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortBy = 'latest';
    public $selectedTags = [];

    #[On('filtersUpdated')]
    public function updateFilters($search, $sortBy, $tags)
    {
        $this->search = $search;
        $this->sortBy = $sortBy;
        $this->selectedTags = $tags;

        $this->resetPage();
        unset($this->creations);
    }

    #[Computed]
    public function creations()
    {
        $query = Creation::with('user');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            });
        }

        if (!empty($this->selectedTags)) {
            $query->where(function ($q) {
                foreach ($this->selectedTags as $tag) {
                    $q->orWhereJsonContains('tags', $tag);
                }
            });
        }

        switch ($this->sortBy) {
            case 'most_liked':
                $query->orderBy('likes_count', 'desc');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        return $query->paginate(16);
    }

    #[On('creationAdded')]
    public function refreshCreations()
    {
        unset($this->creations);
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.creations.creations-list');
    }
}
