<?php

namespace App\Livewire\Cohosting;

use App\Models\CoHosting;
use App\Traits\HasImages;
use App\Traits\CoHostingValidation;
use App\Traits\ManagesMultipleImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, HasImages, CoHostingValidation, ManagesMultipleImages;

    public $coHostingId;
    public $coHosting;
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
        $this->coHostingId = $elementId;
        $this->coHosting = CoHosting::findOrFail($elementId);

        if ($this->coHosting->user_id !== auth()->id()) {
            abort(403, 'Action non autorisée.');
        }

        $this->loadExistingData();
    }

    protected function loadExistingData()
    {
        $this->title = $this->coHosting->title;
        $this->description = $this->coHosting->description;
        $this->author_message = $this->coHosting->author_message;
        $this->existingImages = $this->coHosting->image_uuids ?? [];
        $this->available_spots = $this->coHosting->available_spots;
        $this->price_per_person = $this->coHosting->price_per_person;
        $this->address = $this->coHosting->address;
        $this->start_date = $this->coHosting->start_date;
        $this->end_date = $this->coHosting->end_date;
        $this->listing_link = $this->coHosting->listing_link;
        $this->whatsapp = $this->coHosting->whatsapp;
        $this->discord = $this->coHosting->discord;
        $this->twitter = $this->coHosting->twitter;
        $this->instagram = $this->coHosting->instagram;
    }

    protected function rules()
    {
        return $this->getCoHostingEditRules();
    }

    protected function messages()
    {
        return $this->getCoHostingMessages();
    }

    protected function validationAttributes()
    {
        return $this->getCoHostingAttributes();
    }

    public function update()
    {
        if (!$this->validateTotalImages()) {
            return;
        }

        $this->validate();

        try {
            $allImageUuids = $this->getAllImageUuids();

            $this->coHosting->update([
                'title' => $this->title,
                'description' => $this->description,
                'author_message' => $this->author_message,
                'image_uuids' => $allImageUuids,
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
            $this->dispatch('coHostingUpdated');
            $this->dispatch('notifyAlert', message: 'Annonce modifiée avec succès !', type: 'success');

        } catch (\Exception $e) {
            \Log::error('Erreur modification co-hosting: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            $this->dispatch('notifyAlert', message: 'Une erreur est survenue lors de la modification.', type: 'error');
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
        return view('livewire.cohosting.edit');
    }
}
