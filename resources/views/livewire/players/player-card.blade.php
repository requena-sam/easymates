<div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
    <div class="flex h-52">
        <!-- Partie gauche : Gradient + Photo + Numéro -->
        <div class="relative w-52 flex-shrink-0 bg-gradient-to-br {{ $player->getGameColor() }}">
            <!-- Numéro en background -->
            @if($player->player_number)
                <div class="absolute inset-0 flex items-center justify-center opacity-20">
                    <span class="text-white text-[120px] font-black leading-none">
                        {{ $player->player_number }}
                    </span>
                </div>
            @endif

            <!-- Photo de profil centrée -->
            <div class="absolute inset-0 flex items-center justify-center p-6">
                <div class="relative">
                    <img
                        src="{{ $player->getProfilePictureUrl('medium') }}"
                        alt="{{ $player->pseudo }}"
                        class="w-36 h-36 rounded-full border-4 border-white object-cover object-top shadow-2xl group-hover:scale-105 transition-transform duration-300">
                    @if($player->is_streaming)
                        <div
                            class="absolute -bottom-1 -right-1 w-8 h-8 bg-red-500 rounded-full border-4 border-white flex items-center justify-center">
                            <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Badge numéro en haut -->
            @if($player->player_number)
                <div
                    class="absolute top-4 left-4 bg-white/20 backdrop-blur-sm text-white px-3 py-1 rounded-lg text-sm font-bold">
                    #{{ $player->player_number }}
                </div>
            @endif
        </div>

        <!-- Partie droite : Informations -->
        <div class="flex-1 p-6 flex flex-col justify-between">
            <!-- Header -->
            <div>
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $player->pseudo }}</h3>
                        <p class="text-sm text-gray-600">{{ $player->full_name }}</p>
                    </div>
                    @if($player->role)
                        <span
                            class="px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full text-xs font-medium whitespace-nowrap">
                            {{ $player->role }}
                        </span>
                    @endif
                </div>

                @if($player->description)
                    <p class="text-sm text-gray-600 line-clamp-2 mb-4">
                        {{ $player->description }}
                    </p>
                @endif
            </div>

            <!-- Footer : Réseaux sociaux -->
            <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                @if($player->twitch)
                    <x-twitch isCta="true" link="{{$player->twitch}}"></x-twitch>
                @endif

                @if($player->youtube)
                    <x-youtube isCta="true" link="{{$player->youtube}}"></x-youtube>
                @endif

                @if($player->twitter)
                    <x-twitter isCta="true" link="{{$player->twitter}}"></x-twitter>
                @endif

                @if($player->instagram)
                    <x-instagram isCta="true" link="{{$player->instagram}}"></x-instagram>
                @endif
            </div>
        </div>
    </div>
</div>
