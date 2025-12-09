<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public function mount(Comment $comment)
    {
        $this->comment = $comment->load('user');
    }

    public function like()
    {
        $this->comment->increment('likes_count');
        $this->comment->refresh();
    }

    public function dislike()
    {
        $this->comment->increment('dislikes_count');
        $this->comment->refresh();
    }

    public function render()
    {
        return view('livewire.comments.comment-item');
    }
}
