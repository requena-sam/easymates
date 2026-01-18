<?php

namespace App\Livewire\Cohosting;

use App\Models\CoHosting;
use App\Traits\HasImages;
use App\Traits\CoHostingValidation;
use App\Traits\ManagesMultipleImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, HasImages, CoHostingValidation, ManagesMultipleImages;

    public $event_id;
    public $title;
    public $description;
    public $author_message;
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

    public function mount($elementId)
    {
        $this->event_id = $elementId;
    }

    protected function rules()
    {
        return $this->getCoHostingRules();
    }

    protected function messages()
    {
        return $this->getCoHostingMessages();
    }

    protected function validationAttributes()
    {
        return $this->getCoHostingAttributes();
    }

    public function create()
    {
        // Valider le nombre d'images
        if (!$this->validateTotalImages()) {
            return;
        }

        $this->validate();

        try {
            $imageUuids = $this->getAllImageUuids();

            CoHosting::create([
                'event_id' => $this->event_id,
                'user_id' => auth()->id(),
                'title' => $this->title,
                'description' => $this->description,
                'author_message' => $this->author_message,
                'image_uuids' => $imageUuids,
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
            $this->dispatch('refreshHostingList');
            $this->dispatch('notifyAlert', message: 'Annonce publiée avec succès !', type: 'success');
            $this->resetForm();

        } catch (\Exception $e) {
            \Log::error('Erreur création co-hosting: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la publication.', type: 'error');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'title',
            'description',
            'author_message',
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

        $this->resetImages();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.cohosting.create');
    }
}
