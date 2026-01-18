<?php

namespace App\Traits;

trait CoHostingValidation
{
    protected function getCoHostingRules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'author_message' => 'nullable|min:10',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'required|image|mimes:jpeg,jpg,png,webp|max:2048|dimensions:max_width=3000,max_height=2000',
            'available_spots' => 'required|integer|min:1|max:20',
            'price_per_person' => 'required|numeric|min:0|max:9999.99',
            'address' => 'required|min:5|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'listing_link' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:50',
            'discord' => 'nullable|string|max:50',
            'twitter' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:50',
        ];
    }
    protected function getCoHostingEditRules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'author_message' => 'nullable|min:10',
            'images.*' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'available_spots' => 'required|integer|min:1|max:20',
            'price_per_person' => 'required|numeric|min:0|max:9999.99',
            'address' => 'required|min:5|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'listing_link' => 'nullable|url',
            'whatsapp' => 'nullable|string|max:50',
            'discord' => 'nullable|string|max:50',
            'twitter' => 'nullable|string|max:50',
            'instagram' => 'nullable|string|max:50',
        ];
    }
    protected function getCoHostingMessages(): array
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.min' => 'Le titre doit contenir au moins 3 caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',
            'description.required' => 'La description est requise.',
            'description.min' => 'La description doit contenir au moins 10 caractères.',
            'author_message.min' => 'Le message personnel doit contenir au moins 10 caractères.',
            'images.required' => 'Au moins une image est requise.',
            'images.min' => 'Au moins une image est requise.',
            'images.max' => 'Vous ne pouvez pas télécharger plus de 5 images.',
            'images.*.image' => 'Le fichier doit être une image valide.',
            'images.*.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
            'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
            'available_spots.required' => 'Le nombre de places est requis.',
            'available_spots.integer' => 'Le nombre de places doit être un nombre entier.',
            'available_spots.min' => 'Il doit y avoir au moins 1 place disponible.',
            'available_spots.max' => 'Le nombre maximum de places est de 20.',
            'price_per_person.required' => 'Le prix par personne est requis.',
            'price_per_person.numeric' => 'Le prix doit être un nombre valide.',
            'price_per_person.min' => 'Le prix ne peut pas être négatif.',
            'price_per_person.max' => 'Le prix ne peut pas dépasser 9999.99€.',
            'address.required' => 'L\'adresse est requise.',
            'address.min' => 'L\'adresse doit contenir au moins 5 caractères.',
            'address.max' => 'L\'adresse ne peut pas dépasser 255 caractères.',
            'start_date.required' => 'La date de début est requise.',
            'start_date.date' => 'La date de début doit être une date valide.',
            'start_date.after_or_equal' => 'La date de début doit être aujourd\'hui ou dans le futur.',
            'end_date.required' => 'La date de fin est requise.',
            'end_date.date' => 'La date de fin doit être une date valide.',
            'end_date.after' => 'La date de fin doit être après la date de début.',
            'listing_link.url' => 'Le lien de l\'annonce doit être une URL valide.',
            'whatsapp.max' => 'Le numéro WhatsApp ne peut pas dépasser 50 caractères.',
            'discord.max' => 'Le nom d\'utilisateur Discord ne peut pas dépasser 50 caractères.',
            'twitter.max' => 'Le nom d\'utilisateur Twitter ne peut pas dépasser 50 caractères.',
            'instagram.max' => 'Le nom d\'utilisateur Instagram ne peut pas dépasser 50 caractères.',
            'image.dimensions' => 'L\'image ne doit pas dépasser 3000x2000 pixels.',
        ];
    }

    protected function getCoHostingAttributes(): array
    {
        return [
            'title' => 'titre',
            'description' => 'description',
            'author_message' => 'message personnel',
            'images' => 'images',
            'available_spots' => 'places disponibles',
            'price_per_person' => 'prix par personne',
            'address' => 'adresse',
            'start_date' => 'date de début',
            'end_date' => 'date de fin',
            'listing_link' => 'lien de l\'annonce',
            'whatsapp' => 'WhatsApp',
            'discord' => 'Discord',
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
        ];
    }
}
