<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Creation;
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

        $comment = Comment::create([
            'creation_id' => $this->creationId,
            'user_id' => auth()->id(),
            'content' => $this->content,
        ]);

        Creation::find($this->creationId)->increment('comments_count');

        $this->reset('content');

        $this->dispatch('commentAdded');
    }

    public function render()
    {
        return view('livewire.comments.create');
    }
}
