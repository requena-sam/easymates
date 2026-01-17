<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-end gap-2">
        @if($creation->user_id === auth()->id())
            <button
                wire:click="$dispatch('openEditModal', { component: 'creations.creation-delete', elementId: {{ $creation->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-24 z-10 p-2 mb-4 sm:p-2.5 bg-red-500 text-white rounded-full hover:bg-red-600">
                <x-icons.delete class="w-4 h-4 sm:w-5 sm:h-5"/>
            </button>

            <button
                wire:click="$dispatch('openEditModal', { component: 'creations.edit', creationId: {{ $creation->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-12 z-10 p-2 mb-4 sm:p-2.5 bg-gray-100 hover:bg-gray-200 text-[var(--color-zinc-900)] rounded-full">
                <x-icons.edit class="w-4 h-4 sm:w-5 sm:h-5"/>
            </button>
        @else
            <button
                wire:click="$dispatch('openEditModal', { component: 'creations.report-creation', creationId: {{ $creation->id }} })"
                class="static sm:absolute sm:-top-12 sm:right-12 z-10 p-2 mb-4 sm:p-2.5 bg-red-500 text-white rounded-full hover:bg-red-600"
                title="Signaler cette création">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </button>
        @endif

        {{-- Bouton modération (admin/modérateur uniquement) --}}
        @role('moderator|admin')
        @if($creation->user_id !== auth()->id())
            <button
                wire:click="$dispatch('openEditModal', { component: 'components.delete-confirmation-moderation', elementId: {{ $creation->id }}, itemType: 'creation' })"
                class="static sm:absolute sm:-top-12 sm:right-24 z-10 p-2 mb-4 sm:p-2.5 bg-orange-600 text-white rounded-full hover:bg-orange-700"
                title="Supprimer (Modération)">
                <x-icons.delete></x-icons.delete>
            </button>
        @endif
        @endrole
    </div>

    <div>
        <!-- En-tête avec auteur et bouton like -->
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-start sm:items-center mb-4 sm:mb-5 relative">
            <div class="flex gap-3 sm:gap-4 items-center flex-1 min-w-0">
                <figure class="w-12 h-12 sm:w-16 sm:h-16 rounded-full overflow-hidden flex-shrink-0">
                    <img src="{{ $creation->user->getProfilePictureURL('small') }}" alt="{{ $creation->user->name }}"
                         class="object-cover w-full h-full">
                </figure>
                <div class="flex flex-col gap-1 min-w-0">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-900 break-words">{{ $creation->title }}</h2>
                    <p class="font-medium text-[var(--color-primary)] text-sm sm:text-base">{{ $creation->user->name }}</p>
                </div>
            </div>

            <button
                wire:click="toggleLike"
                class="cursor-pointer w-full sm:w-auto flex items-center justify-center text-xs sm:text-sm gap-2 rounded-lg p-2.5 sm:p-2.5 {{ $isLiked ? 'bg-[var(--color-pink-900)] text-white' : 'bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)]' }}">
                <x-icons.heart class="w-4 h-4"></x-icons.heart>
                <span>{{ $isLiked ? 'Retirer mon like' : 'Liker la publication' }}</span>
            </button>
        </div>

        <!-- Image -->
        <div class="py-3 sm:py-4">
            <figure class="w-full rounded-2xl flex justify-center items-center overflow-hidden bg-gray-100">
                <img
                    src="{{ $creation->getImageUrl('large') }}"
                    alt="{{ $creation->title }}"
                    class="max-w-full max-h-96 sm:max-h-140 object-contain">
            </figure>
        </div>

        <!-- Contenu principal -->
        <div class="grid grid-cols-1 lg:grid-cols-[2.5fr_1fr] gap-6 sm:gap-8 lg:gap-24 mt-4 sm:mt-5">
            <div class="flex flex-col gap-6 sm:gap-8 min-w-0">
                <!-- Description -->
                <div class="flex flex-col gap-3 sm:gap-4">
                    <h3 class="font-semibold text-lg sm:text-xl text-gray-900">Description</h3>
                    <p class="text-sm sm:text-base text-gray-700 leading-relaxed break-words whitespace-pre-wrap">{{ $creation->description }}</p>
                </div>

                <!-- Commentaires -->
                <div class="flex flex-col gap-4 sm:gap-6">
                    <div class="flex items-center gap-2 sm:gap-3">
                        <h3 class="font-semibold text-xl sm:text-2xl text-gray-900">Commentaires</h3>
                        <span
                            class="px-2 sm:px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full text-xs sm:text-sm font-medium">
                            {{ $creation->comments_count }}
                        </span>
                    </div>
                    @livewire('comments.create', ['creationId' => $creation->id])
                    @livewire('comments.comments-list', ['creationId' => $creation->id])
                </div>
            </div>

            <!-- Tags (sidebar sur desktop, en bas sur mobile) -->
            @if(!empty($creation->tags))
                <div class="lg:sticky lg:h-fit lg:top-2">
                    <div class="flex flex-col gap-3 sm:gap-4">
                        <h3 class="font-semibold text-lg sm:text-xl text-gray-900">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($creation->tags as $tag)
                                <span
                                    class="px-2 sm:px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-pink-900)] rounded-full text-xs sm:text-sm break-words">
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
