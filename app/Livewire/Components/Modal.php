<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Modal extends Component
{
    public $show = false;
    public $component;
    public $size = 'medium';
    public $componentParams = [];

    #[On('openModal')]
    public function openModal($component = null, $size = null, ...$params)
    {
        if ($component) {
            $this->component = $component;
        }

        if ($size) {
            $this->size = $size;
        }

        $this->componentParams = $params;
        $this->show = true;
    }

    #[On('closeModal')]
    public function closeModal()
    {
        $this->show = false;
        $this->dispatch('modalClosed');
        $this->dispatch('resetModalComponent');
    }

    public function render()
    {
        return view('livewire.components.modal');
    }
}
