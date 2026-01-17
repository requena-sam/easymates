<section id="community" class="py-20 px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold mb-4">
                Une communauté créative
            </h2>
            <p class="text-base text-[var(--color-light-grey)]">
                Découvre les meilleures créations de la communauté
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
            @foreach($creations as $creation)
                <div
                    class="aspect-square rounded-2xl bg-white border border-[var(--color-light-grey)]/10 overflow-hidden group cursor-pointer">
                    <img src="{{ $creation['url'] }}"
                         alt="{{ $creation['alt'] }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                         loading="lazy">
                </div>
            @endforeach
        </div>
        <div class="text-center">
            <a href="{{ route('register') }}"
               class="rounded-xl w-fit inline-block px-7 py-4 text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] transition-colors font-medium">
                Rejoindre la communauté
            </a>
        </div>

    </div>
</section>
