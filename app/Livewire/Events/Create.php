<?php

namespace App\Livewire\Events;

use App\Enums\GameName;
use App\Models\Event;
use App\Traits\HasImages;
use App\Traits\EventValidation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages, EventValidation;

    public $name;
    public $game_name;
    public $address;
    public $country;
    public $start_date;
    public $end_date;
    public $description;
    public $image;
    public $official_ticketing_link;
    public $secondary_ticketing_link;

    protected $listeners = ['modalClosed' => 'resetForm'];

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function create()
    {
        $this->validate();

        try {
            $imageUuid = $this->uploadImage($this->image);

            Event::create([
                'name' => $this->name,
                'game_name' => $this->game_name,
                'address' => $this->address,
                'country' => $this->country,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description,
                'image_uuid' => $imageUuid,
                'official_ticketing_link' => $this->official_ticketing_link,
                'secondary_ticketing_link' => $this->secondary_ticketing_link,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('eventAdded');
            $this->sendSuccess('Événement publié avec succès !');
            $this->resetForm();

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue lors de la publication.');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'game_name',
            'address',
            'country',
            'start_date',
            'end_date',
            'description',
            'image',
            'official_ticketing_link',
            'secondary_ticketing_link'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.events.create', [
            'gameNames' => GameName::cases()
        ]);
    }
}
