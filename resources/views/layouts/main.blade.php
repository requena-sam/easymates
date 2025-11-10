<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-[var(--color-background)] h-screen pt-14 pl-18 pr-18 overflow-x-hidden">
<div class="absolute inset-0 -z-10">
    <div class="absolute top-20 -left-120 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
    <div class="absolute bottom-0 -right-110 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
</div>
<div>
    <header class=" flex justify-between">
        <span class="text-3xl font-bold">Easy Mates</span>
        <div class="flex gap-4 items-center">
            @livewire('nav.main-navigation')
            <x-cta-rounded text="{{__('Settings')}}" icon="settings"></x-cta-rounded>
            <x-cta-rounded icon="notify"></x-cta-rounded>
            <x-cta-rounded icon="profile" :links="[
                ['text' => 'Mon profil', 'href' => route('profile.edit')],
                ['text' => 'Se déconnecter', 'href' => route('logout'), 'danger' => true]]">
            </x-cta-rounded>
        </div>
    </header>
</div>
<main>
    {{ $slot }}
</main>
</body>
</html>
