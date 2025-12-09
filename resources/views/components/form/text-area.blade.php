@props([
    'id' => '',
    'placeholder' => '',
    'rows' => 5,
    'required' => false,
    ])
<div class="flex flex-col gap-2">
    <label for="{{$id}}" class="block text-sm font-medium text-laber">
        {{$slot}}
        @if($required)
            <span class="text-dark-pink">*</span>
        @endif
    </label>
    <textarea id="{{$id}}"
              wire:model="{{$id}}"
              rows="{{ $rows }}"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-1 focus:ring-[var(--color-primary)] focus:border-transparent focus:outline-none transition-all"
              placeholder="{{ $placeholder }}"></textarea>
    @error($id)
    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>
