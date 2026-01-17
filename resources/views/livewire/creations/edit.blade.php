<div class="space-y-4 sm:space-y-6">
    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-4 sm:mb-6">{{ __('Edit creation') }}</h2>
    <form wire:submit.prevent="update" class="space-y-4 sm:space-y-6">
        <x-form.input-text wire:model="title" id="title" placeholder="Choisir un titre pour votre creation"
                           required="true">
            Titre de la creation
        </x-form.input-text>

        <x-form.text-area wire:model="description" id="description" rows="4" placeholder="Décrire votre creation ici..."
                          required="true">
            Description
        </x-form.text-area>

        {{-- Image --}}
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Image
            </label>

            <label for="image-upload-edit" class="cursor-pointer block">
                <div
                    class="flex items-center justify-center h-40 sm:h-48 border-2 border-dashed border-gray-300 rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                    <div class="text-center px-4">
                        @if ($image)
                            <div class="relative inline-block">
                                <img src="{{ $image->temporaryUrl() }}"
                                     class="h-24 sm:h-32 mx-auto rounded-lg object-cover">
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
                                Nouvelle image sélectionnée
                            </p>
                        @elseif ($currentImageUuid)
                            <div class="relative inline-block">
                                <img
                                    src="{{ app(\App\Services\ImageService::class)->getUrl($currentImageUuid, 'medium') }}"
                                    class="h-24 sm:h-32 mx-auto rounded-lg object-cover">
                            </div>
                            <p class="text-sm text-gray-500 mt-2">
                                Cliquer pour changer l'image
                            </p>
                        @else
                            <svg class="w-8 h-8 sm:w-10 sm:h-10 mx-auto text-gray-400" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-xs sm:text-sm text-gray-500 mt-2">
                                <span class="font-semibold">Cliquer pour télécharger</span>
                                <span class="hidden sm:inline"> ou glisser-déposer</span>
                            </p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WEBP jusqu'à 2MB</p>
                        @endif
                    </div>
                </div>
            </label>

            <input id="image-upload-edit" type="file" wire:model.live="image" class="sr-only" accept="image/*">

            @error('image')
            <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Tags (optionnel)
            </label>

            <div class="border border-gray-300 rounded-2xl overflow-hidden">
                <div class="p-3 bg-gray-50 border-b border-gray-300">
                    <input
                        type="text"
                        wire:model.live="searchTag"
                        placeholder="Rechercher un tag..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition text-sm">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-3 p-3 sm:p-4 overflow-y-auto"
                     style="max-height: {{ count($filteredTags) > 6 ? '160px' : 'auto' }}">
                    @forelse($filteredTags as $tag)
                        <label
                            class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                            <input
                                type="checkbox"
                                wire:model="tags"
                                value="{{ $tag->value }}"
                                class="w-4 h-4 text-[var(--color-pink-700)] border-gray-300 rounded focus:ring-[var(--color-pink-700)]">
                            <span class="text-sm">{{ ucwords(str_replace(['-', '_'], ' ', $tag->value)) }}</span>
                        </label>
                    @empty
                        <p class="col-span-1 sm:col-span-2 text-center text-gray-500 text-sm py-4">Aucun tag trouvé</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-4">
            <button type="button"
                    wire:click="$dispatch('closeEditModal')"
                    class="px-4 sm:px-6 py-3 sm:py-4 bg-[var(--color-pink-200)] rounded-2xl hover:bg-[var(--color-pink-300)] transition ease-in-out duration-300 font-medium text-center">
                {{ __('Cancel') }}
            </button>
            <button type="submit"
                    wire:target="update"
                    class="px-4 sm:px-6 py-3 sm:py-4 text-white bg-[var(--color-pink-700)] rounded-2xl hover:bg-[var(--color-pink-900)] transition ease-in-out duration-300 font-medium disabled:opacity-50 text-center">
                {{ __('Modifier cette création') }}
            </button>
        </div>
    </form>
</div>
