<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Creation;
use App\Services\NotificationService;
use Livewire\Component;

class Create extends Component
{
    public $creationId;
    public $content = '';

    protected $rules = [
        'content' => 'required|min:1|max:1000',
    ];

    public function mount($creationId, $parentId = null)
    {
        $this->creationId = $creationId;
    }

    public function submit()
    {
        $this->validate();

        Comment::create([
            'creation_id' => $this->creationId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);


        $creation = Creation::find($this->creationId);
        $creation->increment('comments_count');

        $this->reset('content');
        NotificationService::notifyComment($creation->user_id, auth()->id(), $this->creationId);
        $this->dispatch('commentAdded');
        $this->dispatch('notifyAlert', message: "Votre commentaire a été ajouté avec succès.", type: 'success');
    }

    public function render()
    {
        return view('livewire.comments.create');
    }
}
