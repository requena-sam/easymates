<div class="bg-white rounded-xl p-4 sm:p-6">
    {{-- En-tête --}}
    <div class="flex items-start sm:items-center gap-3 mb-4">
        <div class="flex-shrink-0">
            <x-delete-svg></x-delete-svg>
        </div>
        <div class="flex-1 min-w-0">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">Confirmer la suppression</h3>
            <p class="text-xs sm:text-sm text-gray-500">Cette action est irréversible</p>
        </div>
    </div>

    {{-- Message de confirmation --}}
    <div class="mb-6">
        <p class="text-sm sm:text-base text-gray-700">
            Êtes-vous sûr de vouloir supprimer l'événement
            <span class="font-semibold text-gray-900">"{{ $eventName }}"</span> ?
        </p>
        <p class="text-xs sm:text-sm text-gray-600 mt-2">
            Toutes les données associées (co-hébergements, covoiturages) seront également supprimées.
        </p>
    </div>

    {{-- Boutons d'action --}}
    <div class="flex flex-col sm:flex-row gap-3 sm:justify-end">
        <button
            type="button"
            wire:click="cancel"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors order-2 sm:order-1">
            Annuler
        </button>
        <button
            type="button"
            wire:click="delete"
            class="px-4 py-2 text-sm font-medium bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)] transition-colors rounded-lg order-1 sm:order-2">
            Supprimer
        </button>
    </div>
</div>
