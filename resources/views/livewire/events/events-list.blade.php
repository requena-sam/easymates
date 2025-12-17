<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        @foreach($events as $event)

            <a href="{{ route('events.show', $event->id) }}" class="block no-underline">
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col sm:flex-row h-[250px]">
                    {{-- Contenu --}}
                    <div class="flex-1 p-6 flex flex-col justify-between overflow-hidden min-w-0">
                        <p
                            class="w-fit px-4 py-2 rounded-full text-xs font-medium mb-3 bg-pink-200 text-[var(--color-primary)]">
                            {{ $event->game_name }}
                        </p>
                        {{-- Date --}}
                        <div class="flex items-center gap-2 text-[var(--color-primary)] text-sm mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $event->start_date->format('d') }} - {{ $event->end_date->format('d') }} {{ $event->start_date->translatedFormat('F Y') }}</span>
                        </div>

                        {{-- Titre --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-3 overflow-hidden text-ellipsis line-clamp-1" style="display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; word-break: break-word;">
                            {{ $event->name }}
                        </h3>

                        {{-- Localisation --}}
                        <div class="flex items-center gap-2 text-gray-600 text-sm mb-3">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="truncate">{{ $event->address }}</span>
                        </div>

                        {{-- Description --}}
                        <p class="text-gray-600 text-sm mb-4 overflow-hidden line-clamp-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; word-break: break-word;">
                            {{ $event->description }}
                        </p>

                    </div>
                    <div class="w-full sm:w-60 h-48 sm:h-full relative flex-shrink-0">
                        <img
                            src="{{ $event->getImageUrl('medium') }}"
                            alt="{{ $event->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    @if($events->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Aucun événement disponible pour le moment.</p>
        </div>
    @endif
</div>
