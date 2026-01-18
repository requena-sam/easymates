<div class="bg-white rounded-xl">
    <div class="flex items-center gap-2 sm:gap-3 mb-4">
        <div class="p-2 bg-orange-100 rounded-lg">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div>
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">Suppression modération</h3>
            <p class="text-xs sm:text-sm text-gray-500">Action de modération - Cette action est irréversible</p>
        </div>
    </div>

    <div class="mb-4 bg-orange-50 border border-orange-200 rounded-lg p-3 sm:p-4">
        <p class="text-sm sm:text-base text-gray-700">
            Vous êtes sur le point de supprimer {{ $itemType === 'creation' ? 'la création' : 'le co-hébergement' }}
            <span class="font-semibold text-gray-900">"{{ $itemName }}"</span>
            de l'utilisateur <span class="font-semibold text-gray-900">{{ $ownerName }}</span>.
        </p>
        <p class="text-xs sm:text-sm text-orange-700 mt-2 font-medium">
            Cette action sera enregistrée dans les logs de modération
        </p>
    </div>

    <form wire:submit.prevent="delete">
        <div class="mb-6">
            <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">
                Raison de la suppression <span class="text-red-500">*</span>
            </label>
            <textarea
                wire:model="reason"
                id="reason"
                rows="4"
                placeholder="Expliquez la raison de cette suppression (sera envoyée à l'utilisateur)..."
                class="w-full px-3 sm:px-4 py-2 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none text-sm sm:text-base"
                required
            ></textarea>
            @error('reason')
            <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-1 text-xs text-gray-500">
                Minimum 10 caractères - Soyez clair et professionnel
            </p>
        </div>

        <div class="mb-6 bg-gray-50 rounded-lg p-3 sm:p-4">
            <h4 class="text-sm font-semibold text-gray-900 mb-2">Conséquences de la suppression :</h4>
            <ul class="text-xs sm:text-sm text-gray-600 space-y-1">
                @if($itemType === 'creation')
                    <li>• La création sera définitivement supprimée</li>
                    <li>• Tous les commentaires et likes seront supprimés</li>
                @else
                    <li>• Le co-hébergement sera définitivement supprimé</li>
                    <li>• Toutes les données associées seront supprimées</li>
                @endif
                <li>• L'utilisateur recevra une notification avec votre raison</li>
                <li>• L'action sera enregistrée dans les logs de modération</li>
            </ul>
        </div>

        <div class="flex flex-col-reverse sm:flex-row gap-3 justify-end">
            <button
                type="button"
                wire:click="cancel"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-center">
                Annuler
            </button>
            <button
                type="submit"
                class="px-4 py-2 bg-orange-600 text-white hover:bg-orange-700 transition-colors rounded-lg text-sm font-medium text-center disabled:opacity-50 disabled:cursor-not-allowed">
                Supprimer (Modération)
            </button>
        </div>
    </form>
</div>
