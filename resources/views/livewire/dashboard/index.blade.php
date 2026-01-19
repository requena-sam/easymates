<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">

                <section class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-semibold text-gray-900">Événements à venir</h2>
                        <a href="{{ route('events.index') }}" class="text-sm text-[var(--color-primary)] hover:underline">
                            Voir tout
                        </a>
                    </div>

                    @if($upcomingEvents->isEmpty())
                        <p class="text-gray-500 text-center py-8">Aucun événement à venir</p>
                    @else
                        <ul class="space-y-3">
                            @foreach($upcomingEvents as $event)
                                <li>
                                    <a href="{{ route('events.show', $event) }}"
                                       class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition group">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-gray-100">
                                            @if($event->image_uuid)
                                                <img src="{{ $event->getImageUrl('small') }}"
                                                     alt="Photo d'affiche de l'event {{ $event->name }}"
                                                     class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h3 class="font-medium text-gray-900 group-hover:text-[var(--color-primary)] transition truncate">
                                                {{ $event->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ $event->start_date->format('d M Y') }} - {{ $event->country }}
                                            </p>
                                        </div>
                                        <span
                                            class="px-3 py-1 bg-[var(--color-pink-100)] text-[var(--color-primary)] rounded-full text-xs font-medium">
                                        {{ $event->game_name }}
                                    </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>

                @if($myCoHostings->isNotEmpty() || $myCarpools->isNotEmpty())
                    <section class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900 mb-5">Mes annonces</h2>
                        <ul class="space-y-3">
                            @foreach($myCoHostings as $coHosting)
                                <li
                                    wire:click="$dispatch('openModal', { component: 'cohosting.show', size: 'large', coHostingId: {{ $coHosting->id }} })"
                                    class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition cursor-pointer group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center flex-shrink-0 text-blue-600">
                                        <x-icons.house></x-icons.house>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 group-hover:text-[var(--color-primary)] transition truncate">
                                            {{ $coHosting->title }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Co-hosting • {{ $coHosting->available_spots }} places
                                        </p>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">
                                        {{ number_format($coHosting->price_per_person, 2, ',', ' ') }} €
                                    </span>
                                </li>
                            @endforeach

                            @foreach($myCarpools as $carpool)
                                <li
                                    class="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition cursor-pointer group">
                                    <div
                                        class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center flex-shrink-0 text-green-600">
                                        <x-icons.arrow-switch></x-icons.arrow-switch>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-medium text-gray-900 group-hover:text-[var(--color-primary)] transition truncate">
                                            {{ $carpool->departure_address }} → {{ $carpool->arrival_address }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            Covoiturage • {{ $carpool->available_spots }} places
                                        </p>
                                    </div>
                                    <span class="text-sm font-medium text-gray-700">
                                        {{ $carpool->price_per_person }}€
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                @endif

                <section class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-semibold text-gray-900">Mes dernières créations</h2>
                        <a href="{{ route('creations') }}" class="text-sm text-[var(--color-primary)] hover:underline">
                            Voir tout
                        </a>
                    </div>

                    @if($myCreations->isEmpty())
                        <p class="text-gray-500 text-center py-8">Vous n'avez pas encore de création</p>
                    @else
                        <ul class="grid grid-cols-3 gap-4">
                            @foreach($myCreations as $creation)
                                <li
                                    wire:click="$dispatch('openModal', { component: 'creations.show', size: 'large', creationId: {{ $creation->id }} })"
                                    class="cursor-pointer group">
                                    <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 mb-2">
                                        @if($creation->image_uuid)
                                            <img src="{{ $creation->getImageUrl('medium') }}"
                                                 alt="{{ $creation->title }}"
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        @endif
                                    </div>
                                    <h3 class="font-medium text-sm text-gray-900 truncate group-hover:text-[var(--color-primary)] transition">
                                        {{ $creation->title }}
                                    </h3>
                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-600">
                                        <span class="flex items-center gap-1">
                                            <x-icons.heart sizeIcon="4"></x-icons.heart>
                                            {{ $creation->likes_count }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <x-icons.comment></x-icons.comment>
                                            {{ $creation->comments_count }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>

            </div>

            <div class="space-y-6">

                <section class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-xl font-semibold text-gray-900">Mes joueurs</h2>
                        <button
                            x-data
                            wire:click="$dispatch('openModal', { component: 'dashboard.add-favorite-player', size: 'medium' })"
                            class="w-8 h-8 rounded-full bg-[var(--color-pink-700)] text-white flex items-center justify-center hover:bg-[var(--color-pink-900)] transition">
                            <x-icons.add></x-icons.add>
                        </button>
                    </div>

                    @if($favoritePlayers->isEmpty())
                        <p class="text-gray-500 text-center py-8 text-sm">Aucun joueur favori</p>
                    @else
                        <ul class="grid lg:grid-cols-2 sm:grid-cols-3 gap-3" wire:poll.15s="loadPlayers">
                            @foreach($favoritePlayers as $player)
                                <li>
                                    <a href="https://twitch.tv/{{ $player->twitch }}" target="_blank"
                                       class="block group relative">
                                        <div
                                            class="relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-200 {{ $player->is_streaming ? 'hover:border-red-500' : 'hover:border-[var(--color-primary)]' }}">
                                            <div
                                                class="relative aspect-square bg-gradient-to-br {{ $player->getGameColor() }}">
                                                <img src="{{ $player->getProfilePictureUrl('small') }}"
                                                     alt="{{ $player->pseudo }}"
                                                     class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-300">

                                                @if($player->is_streaming)
                                                    <div
                                                        class="absolute top-2 left-2 flex items-center gap-1.5 bg-red-500 text-white px-2 py-0.5 rounded-md text-xs font-bold">
                                                        <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                                                        LIVE
                                                    </div>

                                                    <div
                                                        class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-0.5 rounded text-xs font-medium flex items-center gap-1">
                                                        <x-icons.eyes></x-icons.eyes>
                                                        {{ number_format($player->viewer_count) }}
                                                    </div>
                                                @else
                                                    <div
                                                        class="absolute bottom-2 right-2 bg-black/50 text-white px-2 py-0.5 rounded text-xs font-medium">
                                                        Hors ligne
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="p-3">
                                                <h3 class="font-bold text-sm text-gray-900 truncate group-hover:text-[var(--color-primary)] transition">
                                                    {{ $player->pseudo }}
                                                </h3>
                                                @if($player->is_streaming)
                                                    <p class="text-xs text-gray-500 truncate">{{ $player->game_name }}</p>
                                                @else
                                                    <p class="text-xs text-gray-400">Voir la chaine</p>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </section>

                <!-- Stats rapides -->
                <section
                    class="bg-gradient-to-br from-[var(--color-pink-700)] to-[var(--color-pink-900)] rounded-2xl p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Statistiques</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-white/80">Créations</span>
                            <span class="font-bold text-xl">{{ auth()->user()->creations()->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-white/80">Annonces</span>
                            <span
                                class="font-bold text-xl">{{ auth()->user()->coHostings()->count() + auth()->user()->carpools()->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-white/80">Joueurs suivis</span>
                            <span class="font-bold text-xl">{{ $favoritePlayers->count() }}</span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    @livewire('components.modal')
</div>
