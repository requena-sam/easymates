<div>
    <form wire:submit="submit">
        <div class="flex gap-3">
            <figure class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                <img src="{{auth()->user()->getProfilePictureUrl('small')}}" alt="{{auth()->user()->name}}"
                     class="object-cover object-top w-full h-full"/>
            </figure>

            <div class="flex-1 relative">
                <textarea
                    wire:model="content"
                    placeholder="Commenter la publication ici..."
                    rows="3"
                    class="w-full px-4 py-3 border border-gray-200 rounded-2xl resize-none focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-transparent"
                ></textarea>

                @error('content')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                @enderror

                <button
                    type="submit"
                    class="absolute bottom-3 right-3 p-2 bg-[var(--color-pink-200)] text-[var(--color-primary)] rounded-full hover:bg-[var(--color-pink-300)] transition-colors">
                    <x-icons.send></x-icons.send>
                </button>
            </div>
        </div>
    </form>
</div>
