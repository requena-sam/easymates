<?php

namespace App\Livewire\Carpool;

use App\Models\Carpool;
use Livewire\Component;

class Create extends Component
{
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

    protected $rules = [
        'departure_country' => 'required|string|max:255',
        'departure_address' => 'required|string|max:255',
        'arrival_address' => 'required|string|max:255',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'price_per_person' => 'required|numeric|min:0|max:9999.99',
        'available_spots' => 'required|integer|min:1|max:8',
        'whatsapp' => 'nullable|string|max:50',
        'discord' => 'nullable|string|max:50',
        'twitter' => 'nullable|string|max:50',
        'instagram' => 'nullable|string|max:50',
    ];

    protected $messages = [
        'departure_country.required' => 'Le pays de départ est requis.',
        'departure_address.required' => 'L\'adresse de départ est requise.',
        'arrival_address.required' => 'L\'adresse d\'arrivée est requise.',
        'start_date.required' => 'La date de départ est requise.',
        'start_date.after_or_equal' => 'La date de départ doit être aujourd\'hui ou dans le futur.',
        'end_date.required' => 'La date de retour est requise.',
        'end_date.after_or_equal' => 'La date de retour doit être après ou égale à la date de départ.',
        'price_per_person.required' => 'Le prix par personne est requis.',
        'available_spots.required' => 'Le nombre de places est requis.',
        'available_spots.min' => 'Il doit y avoir au moins 1 place disponible.',
        'available_spots.max' => 'Maximum 8 places disponibles.',
    ];

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
            $this->dispatch('notifyAlert', message: 'Covoiturage publié avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création carpool: ' . $e->getMessage());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
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
