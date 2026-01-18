<?php

namespace App\Livewire\Players;

use App\Models\Player;
use App\Traits\PlayerValidation;
use Livewire\Component;

class DeleteConfirmation extends Component
{
    use PlayerValidation;

    public $playerId;
    public $playerName;

    public function mount($playerId)
    {
        $player = Player::findOrFail($playerId);
        $this->playerId = $player->id;
        $this->playerName = $player->pseudo;
    }

    public function delete()
    {
        try {
            $player = Player::findOrFail($this->playerId);

            if ($player->profile_picture_uuid) {
                app(\App\Services\ImageService::class)->delete($player->profile_picture_uuid);
            }

            $player->delete();

            $this->dispatch('closeModal');
            $this->dispatch('playerAdded');
            $this->sendSuccess("Le joueur '{$this->playerName}' a été supprimé avec succès.");

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue lors de la suppression.');
        }
    }

    public function cancel()
    {
        $this->dispatch('closeModal');
    }

    public function render()
    {
        return view('livewire.players.delete-confirmation');
    }
}
