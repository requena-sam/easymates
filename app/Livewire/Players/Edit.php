<?php

namespace App\Livewire\Players;

use App\Enums\GameName;
use App\Models\Player;
use App\Traits\HasImages;
use App\Traits\PlayerValidation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, HasImages, PlayerValidation;

    public $playerId;
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
    public $existing_image_uuid;

    protected function rules()
    {
        return [
            'description' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'pseudo' => 'required|min:3|max:50|unique:players,pseudo,' . $this->playerId,
            'first_name' => 'nullable|min:2|max:50',
            'last_name' => 'nullable|min:2|max:50',
            'player_number' => 'nullable|integer|min:0',
            'role' => 'nullable|min:2|max:100',
            'twitch' => 'nullable|min:3|max:255',
            'youtube' => 'nullable|min:3|max:255',
            'twitter' => 'nullable|min:3|max:255',
            'instagram' => 'nullable|min:3|max:255',
        ];
    }

    public function mount($playerId)
    {
        $player = Player::findOrFail($playerId);

        $this->playerId = $player->id;
        $this->description = $player->description;
        $this->pseudo = $player->pseudo;
        $this->first_name = $player->first_name;
        $this->last_name = $player->last_name;
        $this->game_name = $player->game_name;
        $this->player_number = $player->player_number;
        $this->role = $player->role;
        $this->twitch = $player->twitch;
        $this->youtube = $player->youtube;
        $this->twitter = $player->twitter;
        $this->instagram = $player->instagram;
        $this->existing_image_uuid = $player->profile_picture_uuid;
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function update()
    {
        $this->validate();

        try {
            $player = Player::findOrFail($this->playerId);
            $imageUuid = $this->existing_image_uuid;

            if ($this->image) {
                if ($this->existing_image_uuid) {
                    app(\App\Services\ImageService::class)->delete($this->existing_image_uuid);
                }
                $imageUuid = $this->uploadImage($this->image);
            }

            $player->update([
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
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('playerUpdated');
            $this->sendSuccess('Joueur modifié avec succès !');

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue lors de la modification.');
        }
    }

    public function render()
    {
        return view('livewire.players.edit', [
            'gameNames' => GameName::cases()
        ]);
    }
}
