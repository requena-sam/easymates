<?php

namespace App\Traits;

trait CreationValidation
{
    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048|dimensions:max_width=3000,max_height=2000',
    ];

    protected $messages = [
        'title.required' => 'Le titre est obligatoire.',
        'title.min' => 'Le titre doit contenir au moins 3 caractères.',
        'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
        'description.required' => 'La description est obligatoire.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'image.required' => 'L\'image est obligatoire.',
        'image.image' => 'Le fichier doit être une image.',
        'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
        'image.max' => 'L\'image ne peut pas dépasser 2 Mo.',
        'image.dimensions' => 'L\'image ne doit pas dépasser 3000x2000 pixels.',

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
