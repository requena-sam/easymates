<div class="space-y-6">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Signaler ce co-hébergement</h2>

    <form wire:submit.prevent="submit" class="space-y-6">
        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">
                Raison du signalement <span class="text-red-500">*</span>
            </label>

            <div class="space-y-2">
                @foreach(\App\Enums\ReportReason::cases() as $reasonCase)
                    <label
                        class="flex items-start gap-3 p-3 border border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition">
                        <input
                            type="radio"
                            wire:model.live="reason"
                            value="{{ $reasonCase->value }}"
                            class="mt-0.5 w-4 h-4 text-[var(--color-pink-700)] border-gray-300 focus:ring-[var(--color-pink-700)]">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900">{{ $reasonCase->label() }}</p>
                        </div>
                    </label>
                @endforeach
            </div>

            @error('reason')
            <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
            @enderror
        </div>
        <!-- Actions -->
        <div class="flex items-center justify-end gap-3 pt-4">
            <button
                type="button"
                wire:click="$dispatch('closeModal')"
                class="px-6 py-4 bg-[var(--color-pink-200)] rounded-2xl hover:bg-[var(--color-pink-300)] transition ease-in-out duration-300 font-medium">
                Annuler
            </button>
            <button
                type="submit"
                wire:loading.attr="disabled"
                class="px-6 py-4 text-white bg-[var(--color-pink-700)] rounded-2xl hover:bg-[var(--color-pink-900)] transition ease-in-out duration-300 font-medium disabled:opacity-50">
                Signaler
            </button>
        </div>
    </form>
</div>
