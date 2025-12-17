@props([
    'href' => '#',
])
<a target="_blank" href="{{$href}}"
   class="rounded-xl  w-fit block px-7 py-4  bg-pink-200">{{$slot}}</a>
