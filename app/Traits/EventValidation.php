<?php

namespace App\Traits;

trait EventValidation
{
    protected $rules = [
        'name' => 'required|min:3|max:255',
        'game_name' => 'required',
        'address' => 'required|min:3|max:255',
        'country' => 'required|min:2|max:100',
        'start_date' => 'required|date|after_or_equal:today',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048|dimensions:max_width=3000,max_height=2000',
        'official_ticketing_link' => 'nullable|url:http,https|max:2048',
        'secondary_ticketing_link' => 'nullable|url:http,https|max:2048',
    ];

    protected $messages = [
        'name.required' => 'Le nom de l\'événement est obligatoire.',
        'name.min' => 'Le nom doit contenir au moins 3 caractères.',
        'name.max' => 'Le nom ne peut pas dépasser 255 caractères.',
        'game_name.required' => 'Le jeu est obligatoire.',
        'address.required' => 'L\'adresse est obligatoire.',
        'address.min' => 'L\'adresse doit contenir au moins 3 caractères.',
        'country.required' => 'Le pays est obligatoire.',
        'country.min' => 'Le pays doit contenir au moins 2 caractères.',
        'start_date.required' => 'La date de début est obligatoire.',
        'start_date.date' => 'La date de début doit être une date valide.',
        'start_date.after_or_equal' => 'La date de début ne peut pas être dans le passé.',
        'end_date.required' => 'La date de fin est obligatoire.',
        'end_date.date' => 'La date de fin doit être une date valide.',
        'end_date.after_or_equal' => 'La date de fin doit être après la date de début.',
        'description.required' => 'La description est obligatoire.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'image.required' => 'L\'image est obligatoire.',
        'image.dimensions' => 'L\'image ne doit pas dépasser 3000x2000 pixels.',
        'image.image' => 'Le fichier doit être une image.',
        'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
        'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        'official_ticketing_link.url' => 'Le lien de billetterie doit être une URL valide.',
        'secondary_ticketing_link.url' => 'Le lien secondaire doit être une URL valide.',
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
