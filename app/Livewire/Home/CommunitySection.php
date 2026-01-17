<?php

namespace App\Livewire\Home;

use Livewire\Component;

class CommunitySection extends Component
{
    public array $creations = [
        [
            'url' => 'https://i.ibb.co/cKFpP2F1/m8-1.jpg',
            'alt' => 'Création communautaire Gentle Mates',
        ],
        [
            'url' => 'https://i.ibb.co/7tXmvkN1/Wallpaper-Lock-Screen-2026-M8-1.png',
            'alt' => 'Wallpaper Gentle Mates 2026',
        ],
        [
            'url' => 'https://i.ibb.co/w2TR6g0/G1-TDLLj-Xw-AAYGWJ-png-Squoosh.jpg',
            'alt' => 'Fan art Gentle Mates',
        ],
        [
            'url' => 'https://i.ibb.co/KjwRXGt2/17610271358611111.jpg',
            'alt' => 'Création fan Gentle Mates',
        ],
    ];

    public function render()
    {
        return view('livewire.home.community-section');
    }
}
