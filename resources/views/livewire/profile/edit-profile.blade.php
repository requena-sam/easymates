<div class="max-w-4xl mx-auto space-y-8">
    <section class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Informations personnelles</h2>

        <form wire:submit="updateProfile" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Photo de profil
                </label>

                <div class="flex items-center gap-6">
                    <div>
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}"
                                 alt="Aperçu de votre photo de profil"
                                 class="w-24 h-24 rounded-full object-cover">
                        @else
                            <img src="{{ Auth::user()->getProfilePictureUrl('small') }}"
                                 alt="{{ Auth::user()->name }}"
                                 class="w-24 h-24 rounded-full object-cover">
                        @endif
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="photo-upload" class="cursor-pointer">
                            <span
                                class="px-4 py-2 bg-[var(--color-primary)] text-white rounded-lg hover:opacity-90 transition-opacity inline-block text-sm">
                                Changer la photo
                            </span>
                            <input
                                id="photo-upload"
                                type="file"
                                wire:model="photo"
                                accept="image/jpeg,image/jpg,image/png,image/webp"
                                class="hidden">
                        </label>

                        @if (Auth::user()->profile_picture)
                            <button
                                type="button"
                                wire:click="removeProfilePicture"
                                wire:confirm="Voulez-vous vraiment supprimer votre photo de profil ?"
                                class="px-4 py-2 text-sm text-red-600 hover:text-red-700 text-left">
                                Supprimer la photo
                            </button>
                        @endif

                        <div>
                            @error('photo')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">
                                JPG, PNG ou WebP. Max 2 Mo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom complet
                </label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent">
                @error('name')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse email
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent">
                @error('email')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="px-6 py-2 bg-[var(--color-primary)] text-white rounded-lg hover:opacity-90 transition-opacity">
                    Mettre à jour les informations
                </button>
            </div>
        </form>
    </section>

    <section class="bg-white rounded-xl p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-6">Changer le mot de passe</h2>

        <form wire:submit="updatePassword" class="space-y-4">
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Mot de passe actuel
                </label>
                <input
                    type="password"
                    id="current_password"
                    wire:model="current_password"
                    autocomplete="current-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent">
                @error('current_password')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                    Nouveau mot de passe
                </label>
                <input
                    type="password"
                    id="new_password"
                    wire:model="new_password"
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent">
                @error('new_password')
                <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span>
                @enderror
                <p class="text-xs text-gray-500 mt-1">
                    Minimum 8 caractères
                </p>
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirmer le nouveau mot de passe
                </label>
                <input
                    type="password"
                    id="new_password_confirmation"
                    wire:model="new_password_confirmation"
                    autocomplete="new-password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent">
            </div>

            <div class="flex justify-end pt-4">
                <button
                    type="submit"
                    class="px-6 py-2 bg-[var(--color-primary)] text-white rounded-lg hover:opacity-90 transition-opacity">
                    Changer le mot de passe
                </button>
            </div>
        </form>
    </section>
</div>
