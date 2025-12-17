<x-main-layout>
    <div class="grid grid-cols-2 gap-8 mt-24 items-center">

        <div class="flex flex-col gap-6">
            <div class="flex gap-3">
                <div class="w-fit px-4 py-2 rounded-full text-xs font-medium bg-pink-200 text-[var(--color-primary)]">
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>
                        {{ $event->start_date->format('d') }} - {{ $event->end_date->format('d') }}
                            {{ $event->start_date->translatedFormat('F Y') }}
                    </span>
                    </div>
                </div>
                <div class="w-fit px-4 py-2 rounded-full text-xs font-medium bg-pink-200 text-[var(--color-primary)]">
                    {{ $event->address }}
                </div>
            </div>
            <div>
                <h2 class="text-h1 font-bold">{{ $event->name }}</h2>
                <p>{{ $event->description }}</p>

                <div class="flex gap-4 mt-6">
                    <x-primary-btn href="{{ $event->official_ticketing_link }}">
                        Billetterie officielle
                    </x-primary-btn>
                    <x-secondary-btn href="{{ $event->secondary_ticketing_link }}">
                        Billetterie TGS
                    </x-secondary-btn>
                </div>
            </div>

        </div>

        <!-- COLONNE DROITE -->
        <figure>
            <img
                src="{{ $event->getImageUrl('medium') }}"
                alt=""
                class="w-full h-auto rounded-xl object-cover">
        </figure>

    </div>
</x-main-layout>
