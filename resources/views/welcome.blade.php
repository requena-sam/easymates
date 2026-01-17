<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
@include('partials.head')
<body class="bg-[var(--color-background)] text-[var(--color-black)] overflow-x-hidden" x-data="{ mobileOpen: false }">

<!-- Background Gradients -->
<div class="fixed inset-0 -z-10 pointer-events-none">
    <div class="fixed top-20 -left-120 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
    <div class="fixed bottom-0 -right-110 w-140 h-140 rounded-full bg-pink-400/40 blur-3xl"></div>
</div>

<!-- Header -->
<header
    class="fixed top-0 w-full z-50 bg-[var(--color-background)]/80 backdrop-blur-sm border-b border-[var(--color-light-grey)]/10">
    <div class="max-w-7xl mx-auto px-8 py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <img src="{{ asset('storage/images/logo_gentlemates.svg') }}" alt="Logo Gentle Mates"
                 class="w-25 sm:w-[120px]">

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-3">
                <a href="{{ route('login') }}"
                   class="rounded-xl w-fit block px-7 py-3 bg-[var(--color-pink-200)] hover:bg-[var(--color-secondary-dark)] transition-colors text-sm font-medium">
                    Se connecter
                </a>
                <a href="{{ route('register') }}"
                   class="rounded-xl w-fit block px-7 py-3 text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] transition-colors text-sm font-medium">
                    S'inscrire
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileOpen = !mobileOpen"
                    class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors"
                    aria-label="Menu">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileOpen"
             @click.away="mobileOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden mt-4 bg-white rounded-2xl shadow-lg overflow-hidden">
            <nav class="flex flex-col">
                <a href="{{ route('login') }}"
                   @click="mobileOpen = false"
                   class="px-6 py-4 hover:bg-gray-50 transition-colors border-b border-gray-100">
                    Se connecter
                </a>
                <a href="{{ route('register') }}"
                   @click="mobileOpen = false"
                   class="px-6 py-4 hover:bg-gray-50 transition-colors text-[var(--color-primary)] font-medium">
                    S'inscrire
                </a>
            </nav>
        </div>
    </div>
</header>

<!-- Hero  -->
@livewire('home.hero-section')

@livewire('home.features-section')

@livewire('home.community-section')

@livewire('home.cta-section')

@livewire('home.footer-section')

</body>
</html>
