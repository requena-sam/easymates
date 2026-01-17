<section class="pt-46 pb-20 px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <div
                    class="flex gap-2 items-center px-4 py-2 bg-white rounded-full text-sm font-medium border border-[var(--color-light-grey)]/10 w-fit">
                    <span>
                        <img src="{{ asset('storage/images/logo_gentlemates-08.svg') }}" alt="Logo" width="20">
                    </span>
                    Communauté Gentle Mates
                </div>

                <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                    Rejoins la famille<br>
                    <span class="text-[var(--color-primary)]">Gentle Mates</span>
                </h1>

                <p class="text-base text-[var(--color-light-grey)] leading-relaxed max-w-xl">
                    L'application qui facilite la vie des fans. Partage tes créations, découvre les événements et
                    connecte-toi avec d'autres passionnés.
                </p>

                <div class="flex flex-wrap gap-3 pt-4">
                    <a href="{{ route('register') }}"
                       class="rounded-xl w-fit block px-7 py-4 text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] transition-colors font-medium">
                        Commencer gratuitement
                    </a>
                    <a href="#features"
                       class="rounded-xl w-fit block px-7 py-4 bg-[var(--color-pink-200)] hover:bg-[var(--color-secondary-dark)] transition-colors font-medium">
                        En savoir plus
                    </a>
                </div>

                <div class="flex items-center gap-8 pt-8">
                    @foreach($stats as $stat)
                        <div>
                            <div class="text-2xl font-bold">{{ $stat['value'] }}</div>
                            <div class="text-xs text-[var(--color-light-grey)]">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative float-animation flex items-center justify-center">
                <img src="https://i.ibb.co/tP8qbxwV/Groupe-1103-1.webp"
                     alt="Easy Mates App Preview"
                     class="w-full max-w-2xl h-auto drop-shadow-2xl">
            </div>
        </div>
    </div>
</section>
