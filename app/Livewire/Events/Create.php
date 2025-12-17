<?php

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
        'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:3072|dimensions:min_width=200,min_height=200,max_width=4096,max_height=4096',
        'official_ticketing_link' => 'nullable|url',
        'secondary_ticketing_link' => 'nullable|url',
    ];

    protected $messages = [
        'name.required' => 'Le nom de l\'événement est requis.',
        'name.min' => 'Le nom doit contenir au moins 3 caractères.',
        'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
        'game_name.required' => 'Le jeu est requis.',
        'address.required' => 'L\'adresse est requise.',
        'address.min' => 'L\'adresse doit contenir au moins 3 caractères.',
        'country.required' => 'Le pays est requis.',
        'start_date.required' => 'La date de début est requise.',
        'start_date.date' => 'La date de début doit être une date valide.',
        'start_date.after_or_equal' => 'La date de début doit être aujourd\'hui ou dans le futur.',
        'end_date.required' => 'La date de fin est requise.',
        'end_date.date' => 'La date de fin doit être une date valide.',
        'end_date.after_or_equal' => 'La date de fin doit être après ou égale à la date de début.',
        'description.required' => 'La description est requise.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'image.required' => 'Une image est requise.',
        'image.image' => 'Le fichier doit être une image valide.',
        'image.max' => 'L\'image ne doit pas dépasser 3 Mo.',
        'image.mimes' => 'L\'image doit être au format JPEG, JPG, PNG ou WEBP.',
        'image.dimensions' => 'L\'image doit avoir une taille minimale de 200x200 pixels et maximale de 4096x4096 pixels.',
        'official_ticketing_link.url' => 'Le lien de billetterie officiel doit être une URL valide.',
        'secondary_ticketing_link.url' => 'Le lien de billetterie secondaire doit être une URL valide.',
    ];

    public function updatedImage()
    {
        $this->validateOnly('image');
    }

    public function create()
    {
        $this->validate();

        try {
            $imageData = $this->handleImageUpload($this->image);

            Event::create([
                'name' => $this->name,
                'game_name' => $this->game_name,
                'address' => $this->address,
                'country' => $this->country,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'description' => $this->description,
                'image_path' => json_encode($imageData),
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
