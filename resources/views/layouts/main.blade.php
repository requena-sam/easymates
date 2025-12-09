<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-[var(--color-background)] h-screen pt-14 pl-18 pr-18 overflow-x-hidden">
<h1 class="sr-only">{{ Route::currentRouteName() }}</h1>
<div class="fixed inset-0 -z-10 pointer-events-none">
    <div class="fixed top-20 -left-120 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
    <div class="fixed bottom-0 -right-110 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
</div>
<div>
    <header class=" flex justify-between">
        <span class="text-3xl font-bold">Easy Mates</span>
        <div class="flex gap-4 items-center">
            @livewire('nav.main-navigation')
            <x-cta-rounded text="{{__('Settings')}}" icon="settings"></x-cta-rounded>
            <x-cta-rounded icon="notify"></x-cta-rounded>
            <x-cta-rounded icon="profile" :links="[
                ['text' => 'Mon profil', 'href' => route('profile.edit')]]">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                        {{ __('Logout') }}
                    </button>
                </form>
            </x-cta-rounded>
        </div>
    </header>
</div>
<main>
    {{ $slot }}
</main>
</body>
</html>
