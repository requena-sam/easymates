<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Total utilisateurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $users->total() }}</p>
                </div>
                <div class="w-11 h-11 bg-[var(--color-pink-100)] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-[var(--color-primary)]" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Administrateurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::role('admin')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Modérateurs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\User::role('moderator')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <section class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h2 class="sr-only">{{__('Filters section')}}</h2>
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div class="relative flex-1 max-w-md">
                <input
                    type="text"
                    wire:model.live.debounce.100ms="search"
                    placeholder="Rechercher par nom ou email..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <x-icons.search></x-icons.search>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-600">Filtrer par rôle:</label>
                <select
                    wire:model.live="roleFilter"
                    class="pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white bg-no-repeat bg-right"
                    style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3E%3Cpath stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M6 8l4 4 4-4\'/%3E%3C/svg%3E'); background-position: right 0.5rem center; background-size: 1.25rem 1.25rem;">
                    <option value="all">Tous les rôles</option>
                    @foreach($availableRoles as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <h2 class="sr-only">{{__('Users Table')}}</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Utilisateur
                    </th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Email
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Rôle actuel
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Inscription
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $user->getProfilePictureUrl('small') }}"
                                    alt="{{ $user->name }}"
                                    class="w-9 h-9 rounded-full object-cover">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                    @if($user->id === auth()->id())
                                        <span class="text-xs text-[var(--color-primary)] font-medium">(Vous)</span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-3 text-xs text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-3">
                            @php
                                $role = $user->roles->first();
                                $roleColors = [
                                    'admin' => 'bg-purple-100 text-purple-800',
                                    'moderator' => 'bg-blue-100 text-blue-800',
                                    'user' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium {{ $roleColors[$role?->name ?? 'user'] }}">
                                    {{ $role ? ucfirst($role->name) : 'User' }}
                                </span>
                        </td>

                        <td class="px-6 py-3 text-xs text-gray-600">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-3">
                            <select
                                wire:change="updateUserRole({{ $user->id }}, $event.target.value)"
                                class="pl-3 pr-8 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white bg-no-repeat bg-right"
                                style="background-image: url('data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 20 20\'%3E%3Cpath stroke=\'%236b7280\' stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M6 8l4 4 4-4\'/%3E%3C/svg%3E'); background-position: right 0.4rem center; background-size: 1rem 1rem;"
                                @if($user->id === auth()->id()) disabled @endif
                            >
                                <option value="" disabled selected hidden>
                                    Choisir un rôle
                                </option>

                                @foreach($availableRoles as $role)
                                    <option
                                        value="{{ $role }}"
                                        @selected($user->hasRole($role))
                                    >
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <p class="text-gray-500 text-lg">Aucun utilisateur trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </section>
</div>
