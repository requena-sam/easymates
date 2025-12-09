<div class="flex flex-col gap-8">
    @forelse($comments as $comment)
        <livewire:comments.comment-item
            :comment="$comment"
            :key="'comment-'.$comment->id"
        />
    @empty
        <div class="text-center py-8 text-gray-500">
            <p>Aucun commentaire pour le moment. Soyez le premier à commenter !</p>
        </div>
    @endforelse
</div>
