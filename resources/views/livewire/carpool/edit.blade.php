<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ __('Modifier le covoiturage') }}</h2>
    <form wire:submit.prevent="update" class="space-y-6">

        {{-- Pays de départ --}}
        <x-form.input-text id="departure_country" placeholder="Ex: France" required="true">
            Pays de départ
        </x-form.input-text>

        {{-- Adresse de départ --}}
        <x-form.input-text id="departure_address" placeholder="Ex: Paris, 75001" required="true">
            Adresse de départ
        </x-form.input-text>

        {{-- Adresse d'arrivée --}}
        <x-form.input-text id="arrival_address" placeholder="Ex: Lyon, 69001" required="true">
            Adresse d'arrivée
        </x-form.input-text>

        {{-- Dates --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">
                    Date de départ <span class="text-red-500">*</span>
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
                    Date de retour <span class="text-red-500">*</span>
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

        {{-- Prix et places --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-form.input-text id="price_per_person" type="number" step="0.01" placeholder="Ex: 25.00" required="true">
                Prix par personne (€)
            </x-form.input-text>

            <x-form.input-text id="available_spots" type="number" placeholder="Ex: 3" required="true">
                Places disponibles
            </x-form.input-text>
        </div>

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
                    wire:target="update"
                    class="px-6 py-4 text-white bg-[var(--color-pink-700)] rounded-2xl hover:bg-[var(--color-pink-900)] transition ease-in-out duration-300 font-medium disabled:opacity-50 flex items-center gap-2">
                <span>{{ __('Update') }}</span>
            </button>
        </div>
    </form>
</div>
