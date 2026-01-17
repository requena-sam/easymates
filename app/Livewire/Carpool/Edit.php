<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

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

    protected $rules = [
        'departure_country' => 'required|string|max:100',
        'departure_address' => 'required|string|max:255',
        'arrival_address' => 'required|string|max:255',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'price_per_person' => 'required|numeric|min:0|max:9999.99',
        'available_spots' => 'required|integer|min:1|max:50',
        'whatsapp' => 'nullable|string|max:50',
        'discord' => 'nullable|string|max:50',
        'twitter' => 'nullable|string|max:50',
        'instagram' => 'nullable|string|max:50',
    ];

    protected $messages = [
        'departure_country.required' => 'Le pays de départ est obligatoire.',
        'departure_address.required' => 'L\'adresse de départ est obligatoire.',
        'arrival_address.required' => 'L\'adresse d\'arrivée est obligatoire.',
        'start_date.required' => 'La date de départ est obligatoire.',
        'start_date.after_or_equal' => 'La date de départ ne peut pas être dans le passé.',
        'end_date.required' => 'La date de retour est obligatoire.',
        'end_date.after_or_equal' => 'La date de retour doit être après ou égale à la date de départ.',
        'price_per_person.required' => 'Le prix par personne est obligatoire.',
        'price_per_person.numeric' => 'Le prix doit être un nombre.',
        'price_per_person.min' => 'Le prix ne peut pas être négatif.',
        'available_spots.required' => 'Le nombre de places est obligatoire.',
        'available_spots.min' => 'Il doit y avoir au moins 1 place disponible.',
    ];

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
        $this->dispatch('notifyAlert', message: "Le covoiturage a été mis à jour avec succès.", type: 'success');
    }

    public function render()
    {
        return view('livewire.carpool.edit');
    }
}
