@props([
    'id' => '',
    'placeholder' => '',
    'required' => false,
    ])

<div class="flex flex-col gap-2">
    <label for="{{$id}}" class="block text-sm font-medium text-laber">
        {{$slot}}
        @if($required)
            <span class="text-dark-pink">*</span>
        @endif
    </label>
    <input type="text"
           id="{{$id}}"
           wire:model="{{$id}}"
           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-1 focus:ring-[var(--color-primary)] focus:border-transparent focus:outline-none transition-all"
           placeholder="{{$placeholder}}">
    @error("$id")
    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>
