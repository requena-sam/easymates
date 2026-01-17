<?php

// ============================================
// Events\Create.php
// ============================================

namespace App\Livewire\Events;

use App\Enums\GameName;
use App\Models\Event;
use App\Traits\HasImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages;

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

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'game_name' => 'required',
        'address' => 'required|min:3|max:255',
        'country' => 'required|min:2|max:100',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048',
        'official_ticketing_link' => 'nullable|url',
        'secondary_ticketing_link' => 'nullable|url',
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

            Event::create([
                'name' => $this->name,
                'game_name' => $this->game_name,
                'address' => $this->address,
                'country' => $this->country,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description,
                'image_uuid' => $imageUuid, // Simple UUID
                'official_ticketing_link' => $this->official_ticketing_link,
                'secondary_ticketing_link' => $this->secondary_ticketing_link,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('eventAdded');
            $this->dispatch('notifyAlert', message: 'Événement publié avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création événement: ' . $e->getMessage());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
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
