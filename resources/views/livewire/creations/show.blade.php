<div class="max-w-full">
    <div>
        @if($creation->user_id === auth()->id())
            <button
                wire:click="delete"
                class="absolute -top-12 right-24 z-10 p-2.5 bg-red-500 text-white rounded-full hover:bg-red-600">
                <x-icons.delete></x-icons.delete>
            </button>
            <button
                wire:click="$dispatch('openEditModal', { component: 'creations.edit', creationId: {{ $creation->id }} })"
                class="absolute -top-12 right-12 z-10 p-2.5 bg-white rounded-full hover:bg-[var(--color-gray-100)] text-[var(--color-zinc-900)]">
                <x-icons.edit></x-icons.edit>
            </button>
        @endif
    </div>
    <div>
        <div class="flex gap-4 items-center mb-5">
            <figure class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                <img src="{{ $creation->user->profile_picture }}" alt="{{ $creation->user->name }}"
                     class="object-cover w-full h-full">
            </figure>
            <div class="flex flex-col gap-1 min-w-0">
                <h2 class="text-xl font-semibold text-gray-900 break-words">{{ $creation->title }}</h2>
                <p class="font-medium text-primary text-[var(--color-primary)]">{{ $creation->user->name }}</p>
            </div>
        </div>
        <div class="py-4">
            <figure class="w-full rounded-2xl flex justify-center items-center overflow-hidden bg-gray-100">
                <img
                    src="{{ $creation->getImageUrl('large') }}"
                    alt="{{ $creation->title }}"
                    class="max-w-full max-h-140 object-contain">
            </figure>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr] gap-8 lg:gap-24 mt-5">
            <div class="flex flex-col gap-8 min-w-0">
                <div class="flex flex-col gap-4">
                    <h3 class="font-semibold text-xl text-gray-900">Description</h3>
                    <p class="text-gray-700 leading-relaxed break-words whitespace-pre-wrap">{{ $creation->description }}</p>
                </div>
                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-3">
                        <h3 class="font-semibold text-2xl text-gray-900">Commentaires</h3>
                        <span
                            class="px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full text-sm font-medium">
                            {{ $creation->comments_count }}
                        </span>
                    </div>
                    @livewire('comments.create', ['creationId' => $creation->id])
                    @livewire('comments.comments-list', ['creationId' => $creation->id])
                </div>
            </div>
            @if(!empty($creation->tags))
                <div class="sticky h-fit top-2">
                    <div class="flex flex-col gap-4">
                        <h3 class="font-semibold text-xl text-gray-900">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($creation->tags as $tag)
                                <span
                                    class="px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-pink-900)] rounded-full text-sm break-words">
                                    {{ ucwords(str_replace(['-', '_'], ' ', $tag)) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @livewire('components.edit-modal')
</div>
