<div class="mb-6 md:mb-8">
    <div class="flex flex-wrap gap-2 md:gap-3">
        <button
            wire:click="selectGame('all')"
            class="px-4 py-2 md:px-6 md:py-3 rounded-xl text-sm md:text-base font-medium transition {{ $selectedGame === 'all' ? 'bg-[var(--color-pink-700)] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Tous les jeux
        </button>
        @foreach($games as $game)
            <button
                wire:key="game-filter-{{ $game }}"
                wire:click="selectGame('{{ $game }}')"
                class="px-4 py-2 md:px-6 md:py-3 rounded-xl text-base font-medium transition {{ $selectedGame === $game ? 'bg-[var(--color-pink-700)] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                {{ $game }}
            </button>
        @endforeach
    </div>
</div>
