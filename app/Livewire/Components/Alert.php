<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Alert extends Component
{
    public $show = false;
    public $message = '';
    public $type = '';

    #[On('notifyAlert')]
    public function showAlert($message, $type)
    {
        $this->message = $message;
        $this->type = $type;
        $this->show = true;

        $this->dispatch('alert-shown');
    }

    public function closeAlert()
    {
        $this->show = false;
        $this->message = '';
    }

    public function render()
    {
        return view('livewire.components.alert');
    }
}
