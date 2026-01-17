<?php

namespace App\Livewire\Creations;

use App\Enum\PostTags;
use Livewire\Component;

class CreationsFilters extends Component
{
    public $search = '';
    public $sortBy = 'latest';
    public $selectedTags = [];
    public $showSortDropdown = false;
    public $showTagsDropdown = false;

    public function updatedSearch()
    {
        $this->dispatch('filtersUpdated',
            search: $this->search,
            sortBy: $this->sortBy,
            tags: $this->selectedTags
        );
    }

    public function setSortBy($sort)
    {
        $this->sortBy = $sort;
        $this->showSortDropdown = false;

        $this->dispatch('filtersUpdated',
            search: $this->search,
            sortBy: $this->sortBy,
            tags: $this->selectedTags
        );
    }

    public function toggleTag($tag)
    {
        if (in_array($tag, $this->selectedTags)) {
            $this->selectedTags = array_values(array_filter($this->selectedTags, fn($t) => $t !== $tag));
        } else {
            $this->selectedTags[] = $tag;
        }

        $this->dispatch('filtersUpdated',
            search: $this->search,
            sortBy: $this->sortBy,
            tags: $this->selectedTags
        );
    }

    public function clearFilters()
    {
        $this->selectedTags = [];

        $this->dispatch('filtersUpdated',
            search: $this->search,
            sortBy: $this->sortBy,
            tags: []
        );
    }

    public function getSortLabel()
    {
        return match ($this->sortBy) {
            'most_liked' => __('Most Liked'),
            'oldest' => __('Oldest'),
            default => __('Latest'),
        };
    }

    public function render()
    {
        return view('livewire.creations.creations-filters', [
            'availableTags' => PostTags::cases()
        ]);
    }
}
