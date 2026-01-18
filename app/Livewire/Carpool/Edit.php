<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use App\Traits\CarpoolValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests, CarpoolValidation;

    public $carpoolId;
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

    public function mount($carpoolId)
    {
        $carpool = Carpool::findOrFail($carpoolId);

        $this->carpoolId = $carpool->id;
        $this->departure_country = $carpool->departure_country;
        $this->departure_address = $carpool->departure_address;
        $this->arrival_address = $carpool->arrival_address;
        $this->start_date = $carpool->start_date->format('Y-m-d');
        $this->end_date = $carpool->end_date->format('Y-m-d');
        $this->price_per_person = $carpool->price_per_person;
        $this->available_spots = $carpool->available_spots;
        $this->whatsapp = $carpool->whatsapp;
        $this->discord = $carpool->discord;
        $this->twitter = $carpool->twitter;
        $this->instagram = $carpool->instagram;
    }

    public function update()
    {
        $this->validate();

        try {
            $carpool = Carpool::findOrFail($this->carpoolId);

            $carpool->update([
                'departure_country' => $this->departure_country,
                'departure_address' => $this->departure_address,
                'arrival_address' => $this->arrival_address,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'price_per_person' => $this->price_per_person,
                'available_spots' => $this->available_spots,
                'whatsapp' => $this->whatsapp,
                'discord' => $this->discord,
                'twitter' => $this->twitter,
                'instagram' => $this->instagram,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('carpoolRefresh');
            $this->sendSuccess('Covoiturage mis à jour avec succès.');

        } catch (\Exception $e) {
            $this->sendError('Une erreur est survenue, merci de contacter un administrateur.');
        }
    }

    public function render()
    {
        return view('livewire.carpool.edit');
    }
}
