<?php

namespace App\Traits;

trait CarpoolValidation
{
    protected $rules = [
        'departure_country' => 'required|string|max:100',
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
        'departure_country.required' => 'Le pays de départ est obligatoire.',
        'departure_address.required' => 'L\'adresse de départ est obligatoire.',
        'arrival_address.required' => 'L\'adresse d\'arrivée est obligatoire.',
        'start_date.required' => 'La date de départ est obligatoire.',
        'start_date.after_or_equal' => 'La date de départ ne peut pas être dans le passé.',
        'end_date.required' => 'La date de retour est obligatoire.',
        'end_date.after_or_equal' => 'La date de retour doit être après la date de départ.',
        'price_per_person.required' => 'Le prix par personne est obligatoire.',
        'price_per_person.numeric' => 'Le prix doit être un nombre.',
        'price_per_person.min' => 'Le prix ne peut pas être négatif.',
        'available_spots.required' => 'Le nombre de places est obligatoire.',
        'available_spots.min' => 'Il doit y avoir au moins 1 place.',
        'available_spots.max' => 'Maximum 8 places disponibles.',
    ];

    protected function sendSuccess(string $message)
    {
        $this->dispatch('notifyAlert', message: $message, type: 'success');
    }

    protected function sendError(string $message)
    {
        $this->dispatch('notifyAlert', message: $message, type: 'error');
    }
}
