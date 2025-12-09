<?php

namespace App\Livewire\Comments;

use App\Models\Creation;
use Livewire\Component;

class CommentsList extends Component
{
    public $creationId;

    protected $listeners = ['commentAdded' => '$refresh'];

    public function mount($creationId)
    {
        $this->creationId = $creationId;
    }

    public function render()
    {
        $comments = Creation::find($this->creationId)
            ->comments()
            ->with('user')
            ->latest()
            ->get();

        return view('livewire.comments.comments-list', [
            'comments' => $comments
        ]);
    }
}
