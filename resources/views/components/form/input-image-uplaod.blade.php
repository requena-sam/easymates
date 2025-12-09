<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">
        {{ __('Image') }} <span class="text-pink-500">*</span>
    </label>
    <div class="flex items-center justify-center w-full">
        <label for="image"
               class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-all">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                @if($image)
                    <img src="{{ $image->temporaryUrl() }}" class="h-32 object-cover rounded-lg mb-2">
                    <p class="text-sm text-gray-600">{{ __('Click to change image') }}</p>
                @else
                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    <p class="mb-2 text-sm text-gray-500">
                        <span class="font-semibold">{{ __('Click to upload') }}</span>
                        {{ __('or drag and drop') }}
                    </p>
                    <p class="text-xs text-gray-500">PNG, JPG (MAX. 2MB)</p>
                @endif
            </div>
            <input id="image" type="file" class="hidden" wire:model="image" accept="image/*">
        </label>
    </div>
    @error('image')
    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
    @enderror
</div>
