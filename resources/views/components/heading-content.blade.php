@props([
    'title' => null
])
<div class="max-w-200 mx-auto text-center flex flex-col gap-2">
    <h2 class="text-h1 font-bold">{{ $title }}</h2>
    <p class="text-md">{{ $slot }}</p>
</div>
