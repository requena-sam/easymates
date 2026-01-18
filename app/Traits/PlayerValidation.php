<?php

namespace App\Traits;

trait PlayerValidation
{
    protected $rules = [
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048|dimensions:max_width=3000,max_height=2000',
        'pseudo' => 'required|min:3|max:50|unique:players,pseudo',
        'first_name' => 'nullable|min:2|max:50',
        'last_name' => 'nullable|min:2|max:50',
        'player_number' => 'nullable|integer|min:0',
        'role' => 'nullable|min:2|max:100',
        'twitch' => 'nullable|min:3|max:255',
        'youtube' => 'nullable|min:3|max:255',
        'twitter' => 'nullable|min:3|max:255',
        'instagram' => 'nullable|min:3|max:255',
    ];

    protected $messages = [
        'description.required' => 'La description est obligatoire.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'image.required' => 'L\'image est obligatoire.',
        'image.image' => 'Le fichier doit être une image.',
        'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
        'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        'pseudo.required' => 'Le pseudo est obligatoire.',
        'pseudo.min' => 'Le pseudo doit contenir au moins 3 caractères.',
        'pseudo.max' => 'Le pseudo ne peut pas dépasser 50 caractères.',
        'pseudo.unique' => 'Ce pseudo est déjà utilisé.',
        'image.dimensions' => 'L\'image ne doit pas dépasser 3000x2000 pixels.',
        'first_name.min' => 'Le prénom doit contenir au moins 2 caractères.',
        'last_name.min' => 'Le nom doit contenir au moins 2 caractères.',
        'player_number.integer' => 'Le numéro doit être un nombre entier.',
        'role.min' => 'Le rôle doit contenir au moins 2 caractères.',
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
