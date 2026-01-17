<section id="features" class="py-20 px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold mb-4">
                Tout ce dont tu as besoin
            </h2>
            <p class="text-base text-[var(--color-light-grey)]">
                Une plateforme complète pour vivre ta passion Gentle Mates
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($features as $feature)
                <article
                    class="bg-white rounded-2xl p-8 border border-[var(--color-light-grey)]/10 hover:shadow-lg transition-all duration-300">
                    <div class="w-14 h-14 bg-[var(--color-primary)] rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="{{ $feature['icon'] }}"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-[var(--color-light-grey)] mb-6 leading-relaxed">
                        {{ $feature['description'] }}
                    </p>
                    <a href="{{ route('register') }}"
                       class="text-[var(--color-primary)] font-medium text-sm hover:underline inline-flex items-center gap-1">
                        En savoir plus
                        <span aria-hidden="true">→</span>
                    </a>
                </article>
            @endforeach
        </div>

    </div>
</section>
