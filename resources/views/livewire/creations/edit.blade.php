<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Edit creation') }}</h2>
    <form wire:submit.prevent="update" class="space-y-6">
        <x-form.input-text wire:model="title" id="title" placeholder="Choisir un titre pour votre creation" required="true">
            Titre de la creation
        </x-form.input-text>

        <x-form.text-area wire:model="description" id="description" rows="4" placeholder="Décrire votre creation ici..." required="true">
            Description
        </x-form.text-area>

        <x-form.input-text wire:model="image" id="image" placeholder="Url de l'image" required="true">
            Url de votre image
        </x-form.input-text>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Tags (optionnel)
            </label>

            <div class="border border-gray-300 rounded-2xl overflow-hidden">
                <!-- Search bar inside -->
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
                    wire:click="$dispatch('closeEditModal')"
                    class="px-6 py-4 bg-[var(--color-pink-200)] rounded-2xl hover:bg-[var(--color-pink-300)] transition ease-in-out duration-300 font-medium">
                {{ __('Cancel') }}
            </button>
            <button type="submit"
                    class="px-6 py-4 text-white bg-[var(--color-pink-700)] rounded-2xl hover:bg-[var(--color-pink-900)] transition ease-in-out duration-300 font-medium">
                {{ __('Modifier cette création') }}
            </button>
        </div>
    </form>
</div>
