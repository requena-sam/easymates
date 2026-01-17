<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white antialiased dark:bg-neutral-950 overflow-hidden">
<div class="absolute inset-0 -z-10">
    <div class="absolute top-0 -left-100 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
    <div class="absolute bottom-0 -right-100 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
</div>
<div class="bg-background flex min-h-screen flex-col items-center justify-center gap-6 p-6 md:p-10 relative z-10">
    <div class="flex w-full max-w-sm flex-col gap-2">
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex h-16 w-16 mb-1 items-center justify-center rounded-md">
                <img src="{{ asset('storage/images/logo_gentlemates-12.svg') }}" alt="Logo du site">
                </span>
            <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <div class="flex flex-col gap-6">
            {{ $slot }}
        </div>
    </div>
</div>

@fluxScripts
</body>
</html>
