<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Add a new creation') }}</h2>
    <form wire:submit.prevent="create" class="space-y-6">
        <x-form.input-text id="title" placeholder="Choisir un titre pour votre creation" required="true">
            Titre de la creation
        </x-form.input-text>

        <x-form.text-area id="description" rows="4" placeholder="Décrire votre creation ici..." required="true">
            Description
        </x-form.text-area>

        <!-- Upload d'image -->
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Image <span class="text-red-500">*</span>
            </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-2xl hover:border-[var(--color-pink-700)] transition">
                <div class="space-y-1 text-center w-full">
                    @if ($image)
                        <div class="mb-4 relative">
                            <img src="{{ $image->temporaryUrl() }}" class="mx-auto max-h-64 w-auto rounded-lg shadow-lg">
                            <button
                                type="button"
                                wire:click="$set('image', null)"
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    @else
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif

                    <div class="flex justify-center text-sm text-gray-600">
                        <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-[var(--color-pink-700)] hover:text-[var(--color-pink-900)] focus-within:outline-none">
                            <span>{{ $image ? 'Changer l\'image' : 'Télécharger une image' }}</span>
                            <input id="image-upload" type="file" wire:model.live="image" class="sr-only" accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, WEBP jusqu'à 10MB - Haute qualité</p>
                </div>
            </div>

            @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
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

                <div class="grid grid-cols-2 gap-3 p-4 overflow-y-auto"
                     style="max-height: {{ count($filteredTags) > 6 ? '160px' : 'auto' }}">
                    @forelse($filteredTags as $tag)
                        <label class="flex items-center gap-2 cursor-pointer hover:bg-gray-50 p-2 rounded-lg transition">
                            <input
                                type="checkbox"
                                wire:model="tags"
                                value="{{ $tag->value }}"
                                class="w-4 h-4 text-[var(--color-pink-700)] border-gray-300 rounded focus:ring-[var(--color-pink-700)]">
                            <span class="text-sm">{{ ucwords(str_replace(['-', '_'], ' ', $tag->value)) }}</span>
                        </label>
                    @empty
                        <p class="col-span-2 text-center text-gray-500 text-sm py-4">Aucun tag trouvé</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4">
            <button type="button"
                    wire:click="$dispatch('closeModal')"
                    class="px-6 py-4 bg-[var(--color-pink-200)] rounded-2xl hover:bg-[var(--color-pink-300)] transition ease-in-out duration-300 font-medium">
                {{ __('Cancel') }}
            </button>
            <button type="submit"
                    wire:loading.attr="disabled"
                    wire:target="create"
                    class="px-6 py-4 text-white bg-[var(--color-pink-700)] rounded-2xl hover:bg-[var(--color-pink-900)] transition ease-in-out duration-300 font-medium disabled:opacity-50 flex items-center gap-2">
                <span >{{ __('Publish') }}</span>
            </button>
        </div>
    </form>
</div>
