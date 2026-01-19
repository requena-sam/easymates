<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900">
        {{ __('Add a new event') }}
    </h2>

    <form wire:submit.prevent="create" class="space-y-6">

        {{-- Nom --}}
        <x-form.input-text id="name" placeholder="Nom de l'événement" required="true">
            Nom de l'événement
        </x-form.input-text>

        {{-- Jeu (Custom Select avec scroll) --}}
        <div
            x-data="{
                open: false,
                selected: @entangle('game_name').live,
                getLabel(value) {
                    return value || 'Sélectionner un jeu';
                }
            }"
            @click.away="open = false"
            class="relative space-y-2"
        >
            <label class="block text-sm font-medium text-gray-700">
                Jeu <span class="text-red-500">*</span>
            </label>

            <button
                type="button"
                @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 border border-gray-300 rounded-xl bg-white hover:border-[var(--color-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] transition"
            >
                <span
                    class="text-sm"
                    :class="selected ? 'text-gray-900' : 'text-gray-400'"
                    x-text="getLabel(selected)"
                ></span>

                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200"
                     :class="{ 'rotate-180': open }"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute z-50 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg"
                style="display: none; max-height: 240px; overflow-y: auto;"
            >
                @foreach($gameNames as $game)
                    <button
                        type="button"
                        @click="selected = '{{ $game->value }}'; open = false"
                        class="w-full text-left px-4 py-3 text-sm transition duration-150"
                        :class="selected === '{{ $game->value }}' ? 'bg-[var(--color-pink-50)] text-gray-900' : 'text-gray-700 hover:bg-[var(--color-pink-100)]'"
                    >
                        {{ $game->value }}
                    </button>
                @endforeach
            </div>

            @error('game_name')
            <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Adresse / Pays --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input-text id="address" placeholder="Adresse" required="true">
                Adresse
            </x-form.input-text>

            <x-form.input-text id="country" placeholder="Pays" required="true">
                Pays
            </x-form.input-text>
        </div>

        {{-- Dates --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Date de début --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Date de début <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    wire:model.live="start_date"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white hover:border-[var(--color-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] transition"
                >
                @error('start_date')
                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Date de fin --}}
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Date de fin <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    wire:model.live="end_date"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white hover:border-[var(--color-primary)] focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] transition"
                >
                @error('end_date')
                <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Description --}}
        <x-form.text-area id="description" rows="4" placeholder="Décrivez l'événement..." required="true">
            Description
        </x-form.text-area>

        {{-- Image --}}
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Image <span class="text-red-500">*</span>
            </label>

            <label for="image-upload" class="cursor-pointer block">
                <div
                    class="flex items-center justify-center h-48 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition"
                >
                    <div class="text-center">
                        @if ($image)
                            <div class="relative inline-block">
                                <img src="{{ $image->temporaryUrl() }}"
                                     class="h-32 mx-auto rounded-lg object-cover">
                                <button
                                    type="button"
                                    wire:click.stop="$set('image', null)"
                                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Cliquer pour changer
                            </p>
                        @else
                            <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm text-gray-500 mt-2">
                                <span class="font-semibold">Cliquer pour télécharger</span>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP jusqu'à 2MB</p>
                        @endif
                    </div>
                </div>
            </label>

            <input id="image-upload" type="file" wire:model.live="image" class="sr-only" accept="image/*">

            @error('image')
            <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Liens --}}
        <x-form.input-text id="official_ticketing_link" placeholder="https://example.com" required="false">
            Lien billetterie officiel
        </x-form.input-text>

        <x-form.input-text id="secondary_ticketing_link" placeholder="https://example.com" required="false">
            Lien billetterie secondaire
        </x-form.input-text>

        {{-- Actions --}}
        <div class="flex justify-end gap-3 pt-4">
            <button
                type="button"
                wire:click="$dispatch('closeModal')"
                class="px-6 py-3 rounded-xl bg-[var(--color-pink-200)] hover:bg-[var(--color-pink-300)] transition font-medium"
            >
                Annuler
            </button>

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="create"
                class="px-6 py-3 rounded-xl bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)] transition font-medium disabled:opacity-50"
            >
                <span wire:target="create">Publier</span>
            </button>
        </div>

    </form>
</div>
