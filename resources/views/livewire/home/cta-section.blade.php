<section id="about" class="py-20 px-8">
    <div class="max-w-4xl mx-auto">

        <article class="bg-white rounded-3xl p-12 border border-[var(--color-light-grey)]/10 text-center">

            <!-- Title -->
            <h2 class="text-3xl font-bold mb-6">
                L'aventure commence ici.
            </h2>

            <!-- Description -->
            <p class="text-base text-[var(--color-light-grey)] mb-10 max-w-2xl mx-auto">
                Inscris-toi gratuitement et fais partie de la famille Gentle Mates
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-wrap justify-center gap-3">
                <a href="{{ route('register') }}"
                   class="rounded-xl w-fit block px-7 py-4 text-white bg-[var(--color-primary)] hover:bg-[var(--color-primary-dark)] transition-colors font-medium">
                    Créer mon compte
                </a>
                <a href="{{ route('login') }}"
                   class="rounded-xl w-fit block px-7 py-4 bg-[var(--color-pink-200)] hover:bg-[var(--color-secondary-dark)] transition-colors font-medium">
                    J'ai déjà un compte
                </a>
            </div>

        </article>

    </div>
</section>
