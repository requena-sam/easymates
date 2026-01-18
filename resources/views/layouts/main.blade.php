<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.head')
<body class="bg-[var(--color-background)] overflow-x-hidden md:px-8 lg:px-18 md:pt-8 md:pb-16">
<h1 class="sr-only">{{ Route::currentRouteName() }}</h1>
<div class="fixed inset-0 -z-10 pointer-events-none">
    <div class="fixed top-20 -left-120 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
    <div class="fixed bottom-0 -right-110 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
</div>
<header
    class="container mx-auto flex justify-between items-center py-6 px-5 md:py-0 md:px-0 sticky top-0 z-50 bg-[var(--color-background)]/80 backdrop-blur-sm border-b border-[var(--color-light-grey)]/10 md:static md:z-auto md:bg-transparent md:backdrop-blur-0 md:border-0 ">
    <img
        src="{{ asset('storage/images/logo_gentlemates.svg') }}"
        alt="Logo du site"
        class="w-20 sm:w-[120px]">
    <nav class="flex gap-4 items-center max-h-11">
        <h2 class="sr-only">{{__('Main Navigation')}}</h2>
        @livewire('nav.main-navigation')
        @livewire('notifications.dropdown')

        <x-cta-rounded icon="profile" :links="[
                ['text' => 'Mon dashboard', 'href' => route('dashboard')],
                ['text' => 'Mon profil', 'href' => route('profile')]]"
                       :adminLinks="[
                ['text' => 'Administration', 'href' => route('admin')]]">
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit"
                        class="w-full text-left px-4 py-3 rounded-b-2xl text-sm text-red-600 hover:bg-red-50">
                    {{ __('Logout') }}
                </button>
            </form>
        </x-cta-rounded>
    </nav>
</header>

<main class="px-5 md:px-0">
    {{ $slot }}
</main>
</body>
</html>
