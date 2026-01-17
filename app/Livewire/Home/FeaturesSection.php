<?php

namespace App\Livewire\Home;

use Livewire\Component;

class FeaturesSection extends Component
{
    public array $features = [
        [
            'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
            'title' => 'Créations communautaires',
            'description' => 'Partage tes fan-arts, wallpapers et photos. Découvre le talent de la communauté.',
        ],
        [
            'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
            'title' => 'Événements & Rencontres',
            'description' => 'Suis les compétitions, trouve des co-voiturages et hébergements partagés.',
        ],
        [
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            'title' => 'Infos joueurs',
            'description' => 'Reste informé sur tous les joueurs Gentle Mates. Stats et actualités en temps réel.',
        ],
    ];

    public function render()
    {
        return view('livewire.home.features-section');
    }
}
