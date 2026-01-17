<?php

namespace App\Livewire\Players;

use App\Enums\GameName;
use App\Models\Player;
use App\Traits\HasImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages;

    public $description;
    public $pseudo;
    public $first_name;
    public $last_name;
    public $game_name;
    public $player_number;
    public $role;
    public $twitch;
    public $youtube;
    public $twitter;
    public $instagram;
    public $image;

    protected $listeners = ['modalClosed' => 'resetForm'];

    protected $rules = [
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        'pseudo' => 'required|min:3|max:50|unique:players,pseudo',
        'first_name' => 'nullable|min:2|max:50',
        'last_name' => 'nullable|min:2|max:50',
        'player_number' => 'nullable|integer|min:0',
        'role' => 'nullable|min:2|max:100',
        'twitch' => 'nullable|min:3|max:255',
        'youtube' => 'nullable|min:3|max:255',
        'twitter' => 'nullable|min:3|max:255',
        'instagram' => 'nullable|min:3|max:255',
    ];

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function create()
    {
        $this->validate();

        try {
            $imageUuid = $this->uploadImage($this->image);

            Player::create([
                'pseudo' => $this->pseudo,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'game_name' => $this->game_name,
                'player_number' => $this->player_number,
                'description' => $this->description,
                'profile_picture_uuid' => $imageUuid,
                'role' => $this->role,
                'twitch' => $this->twitch,
                'youtube' => $this->youtube,
                'twitter' => $this->twitter,
                'instagram' => $this->instagram,
                'is_streaming' => false,
                'viewer_count' => 0,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('playerAdded');
            $this->dispatch('notifyAlert', message: 'Joueur créer avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création: ' . $e->getMessage());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
        }
    }

    public function resetForm()
    {
        $this->reset(['pseudo', 'first_name', 'last_name', 'game_name', 'player_number', 'description', 'image', 'role', 'twitch', 'youtube', 'twitter', 'instagram']);
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.players.create', [
            'gameNames' => GameName::cases()
        ]);
    }
}
