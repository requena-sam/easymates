<?php

namespace App\Livewire\Nav;

use Livewire\Component;

class MainNavigation extends Component
{
    public array $links;

    public function mount(){
        $this->links = [
            'dashboard' => [
                'text' => 'Dashboard',
                'route' => 'dashboard',
            ],
            'creations' => [
                'text' => 'Créations',
                'route' => 'creations',
            ],
            'events' => [
                'text' => 'Événements',
                'route' => 'events',
            ],
            'players' => [
                'text' => 'Joueurs',
                'route' => 'players',
            ]
        ];
    }
    public function render()
    {
        return view('livewire.nav.main-navigation');
    }
}
