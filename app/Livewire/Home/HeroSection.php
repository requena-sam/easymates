<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HeroSection extends Component
{
    public array $stats = [
        ['value' => '5K+', 'label' => 'Membres actifs'],
        ['value' => '200+', 'label' => 'Créations'],
        ['value' => '50+', 'label' => 'Événements'],
    ];

    public function render()
    {
        return view('livewire.home.hero-section');
    }
}
