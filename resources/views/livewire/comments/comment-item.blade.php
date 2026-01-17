<div class="flex flex-col gap-1">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <figure class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                <img src="{{$comment->user->getProfilePictureUrl('small')}}" alt="{{$comment->user->name}}"
                     class="object-cover object-top w-full h-full"/>
            </figure>
            <p class="font-medium">{{ $comment->user->name }}</p>
        </div>
        <span class="text-sm">{{ $comment->created_at->diffForHumans() }}</span>
    </div>
    <div class="pl-13">
        <p class="text-gray-700 mt-1">{{ $comment->content }}</p>
        <div class="flex items-center gap-4 mt-2 px-2">
            <button
                wire:click="like"
                class="flex items-center gap-1 text-sm text-gray-600 hover:text-[var(--color-primary)] transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                </svg>
                <span>{{ $comment->likes_count }}</span>
            </button>
            <button
                wire:click="dislike"
                class="flex items-center gap-1 text-sm text-gray-600 hover:text-red-500 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path>
                </svg>
                <span>{{ $comment->dislikes_count }}</span>
            </button>
        </div>
    </div>
</div>
