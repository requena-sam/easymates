<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class EditModal extends Component
{
    public $show = false;
    public $component;
    public $componentParams = [];

    #[On('openEditModal')]
    public function openEditModal($component = null, ...$params)
    {
        if ($component) {
            $this->component = $component;
        }

        $this->componentParams = $params;
        $this->show = true;
    }

    #[On('closeEditModal')]
    public function closeEditModal()
    {
        $this->show = false;
        $this->dispatch('editModalClosed');
        $this->dispatch('resetEditModalComponent');
    }

    public function render()
    {
        return view('livewire.components.edit-modal');
    }
}
