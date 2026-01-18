<div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
    <div class="flex flex-col xl:flex-row h-auto xl:h-52">

        <div class="relative w-full xl:w-52 flex-shrink-0 bg-gradient-to-br {{ $player->getGameColor() }}">
            @if($player->player_number)
                <div class="absolute inset-0 flex items-center justify-center opacity-20">
                    <span class="text-white text-[100px] xl:text-[120px] font-black leading-none">
                        {{ $player->player_number }}
                    </span>
                </div>
            @endif

            <div class="flex items-center justify-center p-6">
                <img
                    src="{{ $player->getProfilePictureUrl('medium') }}"
                    alt="{{ $player->pseudo }}"
                    class="z-10 w-28 h-28 sm:w-32 sm:h-32 xl:w-36 xl:h-36 rounded-full border-4 border-white object-cover object-top shadow-2xl group-hover:scale-105 transition-transform duration-300">
            </div>
        </div>
        <div class="flex-1 p-6 flex flex-col justify-between">
            <div>
                <div class="flex flex-col sm:flex-row sm:justify-between gap-2 mb-3">
                    <div>
                        <h3 class="text-xl xl:text-2xl font-bold text-gray-900">
                            {{ $player->pseudo }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $player->full_name }}
                        </p>
                    </div>

                    @if($player->role)
                        <span
                            class="px-3 py-1 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full text-xs font-medium self-start">
                            {{ $player->role }}
                        </span>
                    @endif
                </div>

                @if($player->description)
                    <p class="text-sm text-gray-600 line-clamp-2 break-words break-all">
                        {{ $player->description }}
                    </p>
                @endif
            </div>

            <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                @if($player->twitch)
                    <x-twitch isCta="true" link="{{$player->twitch}}" />
                @endif
                @if($player->youtube)
                    <x-youtube isCta="true" link="{{$player->youtube}}" />
                @endif
                @if($player->twitter)
                    <x-twitter isCta="true" link="{{$player->twitter}}" />
                @endif
                @if($player->instagram)
                    <x-instagram isCta="true" link="{{$player->instagram}}" />
                @endif
            </div>
        </div>

    </div>
</div>
