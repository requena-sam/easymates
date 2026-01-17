<div class="mb-8">
    <div class="flex flex-wrap gap-3">
        <button
            wire:click="selectGame('all')"
            class="px-6 py-3 rounded-xl font-medium transition {{ $selectedGame === 'all' ? 'bg-[var(--color-pink-700)] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
            Tous les jeux
        </button>
        @foreach($games as $game)
            <button
                wire:click="selectGame('{{ $game }}')"
                class="px-6 py-3 rounded-xl font-medium transition {{ $selectedGame === $game ? 'bg-[var(--color-pink-700)] text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                {{ $game }}
            </button>
        @endforeach
    </div>
</div>
