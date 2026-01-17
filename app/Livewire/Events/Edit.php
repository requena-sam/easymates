<?php

// ============================================
// Events\Edit.php
// ============================================

namespace App\Livewire\Events;

use App\Enums\GameName;
use App\Models\Event;
use App\Traits\HasImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, HasImages;

    public $eventId;
    public $name;
    public $game_name;
    public $address;
    public $country;
    public $start_date;
    public $end_date;
    public $description;
    public $image;
    public $existing_image_uuid;
    public $official_ticketing_link;
    public $secondary_ticketing_link;

    protected $listeners = ['modalClosed' => 'resetForm'];

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'game_name' => 'required',
        'address' => 'required|min:3|max:255',
        'country' => 'required|min:2|max:100',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'required|min:10',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
        'official_ticketing_link' => 'nullable|url',
        'secondary_ticketing_link' => 'nullable|url',
    ];

    public function mount($elementId)
    {
        $event = Event::findOrFail($elementId);

        $this->eventId = $event->id;
        $this->name = $event->name;
        $this->game_name = $event->game_name;
        $this->address = $event->address;
        $this->country = $event->country;
        $this->start_date = $event->start_date->format('Y-m-d');
        $this->end_date = $event->end_date->format('Y-m-d');
        $this->description = $event->description;
        $this->existing_image_uuid = $event->image_uuid;
        $this->official_ticketing_link = $event->official_ticketing_link;
        $this->secondary_ticketing_link = $event->secondary_ticketing_link;
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function update()
    {
        $this->validate();

        try {
            $event = Event::findOrFail($this->eventId);
            $imageUuid = $this->existing_image_uuid;
            if ($this->image) {
                if ($this->existing_image_uuid) {
                    app(\App\Services\ImageService::class)->delete($this->existing_image_uuid);
                }
                $imageUuid = $this->uploadImage($this->image);
            }

            $event->update([
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
            $this->dispatch('eventUpdated');
            $this->dispatch('notifyAlert', message: 'Événement modifié avec succès !', type: 'success');

        } catch (\Exception $e) {
            \Log::error('Erreur modification événement: ' . $e->getMessage());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la modification.', type: 'error');
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
        return view('livewire.events.edit', [
            'gameNames' => GameName::cases()
        ]);
    }
}
