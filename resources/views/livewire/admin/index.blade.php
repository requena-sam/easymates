<div class="min-h-screen py-8" x-data="{ tab: 'users' }">
    <div class="max-w-7xl mx-auto">
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Panneau d'administration</h2>
            <p class="text-gray-600">Gérez les utilisateurs et les contenus de la plateforme</p>
        </div>
        <div class="mb-8">
            <nav class="flex gap-8">
                <h2 class="sr-only">{{__('Admin navigation')}}</h2>
                @role('admin')
                <button
                    @click="tab = 'users'"
                    :class="tab === 'users'
                        ? 'border-[var(--color-pink-700)] text-[var(--color-pink-700)]'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-4 border-b-2 font-medium transition">
                    Utilisateurs
                </button>
                @endrole

                <button
                    @click="tab = 'reports'"
                    :class="tab === 'reports'
                        ? 'border-[var(--color-pink-700)] text-[var(--color-pink-700)]'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-4 border-b-2 font-medium transition">
                    Signalements
                </button>

                @role('admin')
                <button
                    @click="tab = 'logs'"
                    :class="tab === 'logs'
                        ? 'border-[var(--color-pink-700)] text-[var(--color-pink-700)]'
                        : 'border-transparent text-gray-500 hover:text-gray-700'"
                    class="pb-4 border-b-2 font-medium transition">
                    Logs
                </button>
                @endrole
            </nav>
        </div>
        <div>
            @role('admin')
            <div x-show="tab === 'users'" x-cloak>
                @livewire('admin.users-management')
            </div>
            @endrole

            <div x-show="tab === 'reports'" x-cloak>
                @livewire('admin.reports-management')
            </div>
            @role('admin')
            <div x-show="tab === 'logs'" x-cloak>
                @livewire('admin.logs-management')
            </div>
            @endrole
        </div>
    </div>
    @livewire('components.alert')
</div>
