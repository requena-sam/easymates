<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use App\Traits\CarpoolValidation;
use Livewire\Component;

class Create extends Component
{
    use CarpoolValidation;

    public $event_id;
    public $departure_country;
    public $departure_address;
    public $arrival_address;
    public $start_date;
    public $end_date;
    public $price_per_person;
    public $available_spots;
    public $whatsapp;
    public $discord;
    public $twitter;
    public $instagram;

    protected $listeners = ['modalClosed' => 'resetForm'];

    public function mount($elementId)
    {
        $this->event_id = $elementId;
    }

    public function create()
    {
        $this->validate();

        try {
            Carpool::create([
                'event_id' => $this->event_id,
                'user_id' => auth()->id(),
                'departure_country' => $this->departure_country,
                'departure_address' => $this->departure_address,
                'arrival_address' => $this->arrival_address,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'price_per_person' => $this->price_per_person,
                'available_spots' => (int)$this->available_spots,
                'whatsapp' => $this->whatsapp,
                'discord' => $this->discord,
                'twitter' => $this->twitter,
                'instagram' => $this->instagram,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('carpoolRefresh');
            $this->sendSuccess('Covoiturage publié avec succès !');
            $this->resetForm();

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue, merci de contacter un administrateur.');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'departure_country',
            'departure_address',
            'arrival_address',
            'start_date',
            'end_date',
            'price_per_person',
            'available_spots',
            'whatsapp',
            'discord',
            'twitter',
            'instagram'
        ]);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.carpool.create');
    }
}
