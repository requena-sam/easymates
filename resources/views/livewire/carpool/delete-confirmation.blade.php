<div class="bg-white rounded-xl">
    {{-- En-tête --}}
    <div class="flex items-center gap-2 sm:gap-3 mb-4">
        <x-delete-svg></x-delete-svg>
        <div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">Confirmer la suppression</h3>
            <p class="text-xs sm:text-sm text-gray-500">Cette action est irréversible</p>
        </div>
    </div>

    {{-- Message de confirmation --}}
    <div class="mb-6">
        <p class="text-sm sm:text-base text-gray-700">
            Êtes-vous sûr de vouloir supprimer votre covoiturage
            <span class="font-semibold text-gray-900">"{{ $carpoolName }}"</span> ?
        </p>
        <p class="text-xs sm:text-sm text-gray-600 mt-2">
            Les utilisateurs qui pourraient être intéressés ne pourront plus accéder à cette offre.
        </p>
    </div>

    {{-- Boutons d'action --}}
    <div class="flex flex-col-reverse sm:flex-row gap-3 justify-end">
        <button
            type="button"
            wire:click="cancel"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center">
            Annuler
        </button>
        <button
            type="button"
            wire:click="delete"
            class="px-4 py-2 bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)] transition-colors rounded-lg text-sm font-medium text-center">
            Supprimer
        </button>
    </div>
</div>
