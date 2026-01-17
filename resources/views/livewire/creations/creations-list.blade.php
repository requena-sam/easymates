<div>
    @if($this->creations->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">{{ __('No creations found matching your filters.') }}</p>
        </div>
    @else
        <ul class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-7 justify-items-center">
            @foreach($this->creations as $creation)
                <li wire:click="$dispatch('openModal', { component: 'creations.show', size: 'large', creationId: {{ $creation->id }} })"
                    class=" z-1 flex flex-col gap-3 w-full transform hover:scale-102 transition-transform duration-300 ease-in-out cursor-pointer group">
                    <figure class="h-56 relative overflow-hidden rounded-2xl">
                        <img src="{{ $creation->getImageUrl('medium') }}" alt="{{ $creation->title }}"
                             class="w-full h-full object-cover"/>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                            <h3 class="text-white font-medium px-4 pb-4 w-full">
                                {{ $creation->title }}
                            </h3>
                        </div>
                    </figure>

                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <figure class="w-8 h-8 rounded-full overflow-hidden">
                                <img src="{{$creation->user->getProfilePictureUrl('small')}}" alt=""
                                     class="object-cover object-top w-full h-full"/>
                            </figure>
                            <p class="text-sm">{{$creation->user->name}}</p>
                        </div>
                        <div class="flex items-center gap-0.5 px-1">
                            <x-icons.heart sizeIcon="5"></x-icons.heart>
                            <span class="text-sm ml-1">{{ $creation->likes_count }}</span>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $this->creations->links() }}
        </div>
    @endif
</div>
