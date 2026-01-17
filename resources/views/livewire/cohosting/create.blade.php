<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Add a new co-hosting') }}</h2>
    <form wire:submit.prevent="create" class="space-y-6">

        {{-- Titre --}}
        <x-form.input-text id="title" placeholder="Titre de votre co-hébergement" required="true">
            Titre
        </x-form.input-text>

        {{-- Description --}}
        <x-form.text-area id="description" rows="4" placeholder="Décrivez votre logement..." required="true">
            Description
        </x-form.text-area>

        {{-- Message de l'auteur --}}
        <x-form.text-area id="author_message" rows="3" placeholder="Message personnel aux futurs colocataires...">
            Message personnel (optionnel)
        </x-form.text-area>

        {{-- Upload d'images multiples --}}
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Images ({{ count($images) }}/5) <span class="text-red-500">*</span>
            </label>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($images as $index => $image)
                    <div class="relative group">
                        <img src="{{ $image->temporaryUrl() }}"
                             class="w-full h-32 object-cover rounded-lg shadow">
                        <button
                            type="button"
                            wire:click="removeImage({{ $index }})"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <div class="absolute bottom-2 left-2 bg-black/50 text-white text-xs px-2 py-1 rounded">
                            {{ $index + 1 }}
                        </div>
                    </div>
                @endforeach

                @if(count($images) < 5)
                    <label
                        class="border-2 border-dashed border-gray-300 rounded-lg cursor-pointer flex flex-col items-center justify-center h-32 hover:border-[var(--color-pink-700)] hover:bg-gray-50 transition">
                        <input type="file" wire:model.live="images" class="sr-only" multiple accept="image/*">
                        <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span class="text-xs text-gray-500">Ajouter des images</span>
                    </label>
                @endif
            </div>

            <p class="text-xs text-gray-500">PNG, JPG, WEBP jusqu'à 2MB par image (max 5 images)</p>

            @error('images.*')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
            @error('images')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Infos logement --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input-text id="available_spots" type="number" placeholder="Ex: 2" required="true">
                Places disponibles
            </x-form.input-text>

            <x-form.input-text id="price_per_person" type="number" step="0.01" placeholder="Ex: 50.00" required="true">
                Prix par personne (€)
            </x-form.input-text>
        </div>

        {{-- Adresse --}}
        <x-form.input-text id="address" placeholder="Adresse du logement" required="true">
            Adresse
        </x-form.input-text>

        {{-- Dates --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

        {{-- Lien listing --}}
        <x-form.input-text id="listing_link" placeholder="https://airbnb.com/..." required="false">
            Lien de l'annonce (optionnel)
        </x-form.input-text>

        {{-- Réseaux sociaux --}}
        <div class="space-y-4">
            <h3 class="text-lg font-semibold text-gray-900">Informations de contact (optionnel)</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input-text id="whatsapp" placeholder="+33 6 12 34 56 78">
                    WhatsApp
                </x-form.input-text>

                <x-form.input-text id="discord" placeholder="username#1234">
                    Discord
                </x-form.input-text>

                <x-form.input-text id="twitter" placeholder="@username">
                    Twitter/X
                </x-form.input-text>

                <x-form.input-text id="instagram" placeholder="@username">
                    Instagram
                </x-form.input-text>
            </div>
        </div>

        {{-- Actions --}}
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
                <span>{{ __('Publish') }}</span>
            </button>
        </div>
    </form>
</div>
