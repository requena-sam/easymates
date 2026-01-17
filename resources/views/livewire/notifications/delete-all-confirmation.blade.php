<div class="bg-white rounded-xl p-6">
    {{-- En-tête --}}
    <div class="flex items-center gap-3 mb-4">
        <x-delete-svg></x-delete-svg>
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Supprimer toutes les notifications</h3>
            <p class="text-sm text-gray-500">Cette action est irréversible</p>
        </div>
    </div>

    {{-- Message de confirmation --}}
    <div class="mb-6">
        <p class="text-gray-700">
            Êtes-vous sûr de vouloir supprimer <span class="font-semibold">toutes vos notifications</span> ?
        </p>
        <p class="text-sm text-gray-600 mt-2">
            Toutes vos notifications (lues et non lues) seront définitivement supprimées.
        </p>
    </div>

    {{-- Boutons d'action --}}
    <div class="flex gap-3 justify-end">
        <button
            type="button"
            wire:click="$dispatch('closeModal')"
            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
            Annuler
        </button>
        <button
            type="button"
            wire:click="confirmDeleteAll"
            class="px-4 py-2 bg-[var(--color-pink-700)] text-white hover:bg-[var(--color-pink-900)] transition-colors rounded-lg">
            Tout supprimer
        </button>
    </div>
</div>
