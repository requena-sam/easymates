<?php

namespace App\Livewire\Cohosting;

use App\Models\CoHosting;
use App\Traits\HasImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages;

    public $event_id;
    public $title;
    public $description;
    public $author_message;
    public $images = [];
    public $available_spots;
    public $price_per_person;
    public $address;
    public $start_date;
    public $end_date;
    public $listing_link;
    public $whatsapp;
    public $discord;
    public $twitter;
    public $instagram;

    protected $listeners = ['modalClosed' => 'resetForm'];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'required|min:10',
        'author_message' => 'nullable|min:10',
        'images' => 'required|array|min:1|max:5',
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

    protected $messages = [
        'title.required' => 'Le titre est requis.',
        'title.min' => 'Le titre doit contenir au moins 3 caractères.',
        'description.required' => 'La description est requise.',
        'description.min' => 'La description doit contenir au moins 10 caractères.',
        'images.required' => 'Au moins une image est requise.',
        'images.min' => 'Au moins une image est requise.',
        'images.max' => 'Vous ne pouvez pas télécharger plus de 5 images.',
        'images.*.image' => 'Le fichier doit être une image valide.',
        'images.*.max' => 'Chaque image ne doit pas dépasser 2 Mo.',
        'available_spots.required' => 'Le nombre de places est requis.',
        'available_spots.min' => 'Il doit y avoir au moins 1 place disponible.',
        'price_per_person.required' => 'Le prix par personne est requis.',
        'address.required' => 'L\'adresse est requise.',
        'start_date.required' => 'La date de début est requise.',
        'start_date.after_or_equal' => 'La date de début doit être aujourd\'hui ou dans le futur.',
        'end_date.required' => 'La date de fin est requise.',
        'end_date.after' => 'La date de fin doit être après la date de début.',
        'listing_link.url' => 'Le lien de l\'annonce doit être une URL valide.',
    ];

    public function mount($elementId)
    {
        $this->event_id = $elementId;
    }

    function updatedImages()
    {
        $this->validateOnly('images');
        $this->validateOnly('images.*');
    }

    public
    function removeImage($index)
    {
        array_splice($this->images, $index, 1);
        $this->images = array_values($this->images);
    }

    public
    function create()
    {
        $this->validate();

        try {
            $imageUuids = $this->uploadImages($this->images);

            CoHosting::create([
                'event_id' => $this->event_id,
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'author_message' => $this->author_message,
                'image_uuids' => $imageUuids, // Pas de json_encode si le modèle a un cast 'array'
                'available_spots' => (int)$this->available_spots,
                'price_per_person' => $this->price_per_person,
                'address' => $this->address,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'listing_link' => $this->listing_link,
                'whatsapp' => $this->whatsapp,
                'discord' => $this->discord,
                'twitter' => $this->twitter,
                'instagram' => $this->instagram,
            ]);

            $this->dispatch('closeModal');
            $this->dispatch('coHostingAdded');
            $this->dispatch('notifyAlert', message: 'Annonce publiée avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création co-hosting: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
        }
    }

    public
    function resetForm()
    {
        $this->reset([
            'title',
            'description',
            'author_message',
            'images',
            'available_spots',
            'price_per_person',
            'address',
            'start_date',
            'end_date',
            'listing_link',
            'whatsapp',
            'discord',
            'twitter',
            'instagram'
        ]);
        $this->resetValidation();
    }

    public
    function render()
    {
        return view('livewire.cohosting.create');
    }
}
