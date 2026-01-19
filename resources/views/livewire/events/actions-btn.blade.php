<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-8">
    <a class="hover:text-[var(--color-pink-700)] flex gap-2 items-center" href="{{route('events.index')}}">
        <span><x-icons.arrow-back></x-icons.arrow-back></span>
        <span class="text-sm sm:text-base">Retour à la liste des événements</span>
    </a>

    <div class="flex flex-col sm:flex-row gap-2 w-full sm:w-auto">
        <button
            wire:click="$dispatch('openModal', { component: 'events.edit', elementId: {{ $eventId }} })"
            class="flex items-center justify-center text-xs sm:text-sm gap-2 rounded-lg p-2.5 bg-white hover:bg-[var(--color-gray-100)] text-[var(--color-zinc-900)] transition w-full sm:w-auto">
            <x-icons.edit></x-icons.edit>
            <span>Modifier</span>
        </button>
        <button
            wire:click="$dispatch('openModal', { component: 'events.delete-confirmation', elementId: {{ $eventId }} })"
            class="flex items-center justify-center text-xs sm:text-sm gap-2 rounded-lg p-2.5 bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)] cursor-pointer transition w-full sm:w-auto">
            <x-icons.delete></x-icons.delete>
            <span>Supprimer</span>
        </button>
    </div>
</div>
