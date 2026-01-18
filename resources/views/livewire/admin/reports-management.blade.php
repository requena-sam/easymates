<div class="space-y-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div class="relative flex-1 max-w-md">
                <input
                    type="text"
                    wire:model.live.debounce.100ms="search"
                    placeholder="Rechercher par nom..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <x-icons.search></x-icons.search>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-600">Statut:</label>
                <select
                    wire:model.live="statusFilter"
                    class="pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white">
                    <option value="all">Tous</option>
                    <option value="pending">En attente</option>
                    <option value="resolved">Traités</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-600">Type:</label>
                <select
                    wire:model.live="typeFilter"
                    class="pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white">
                    <option value="all">Tous</option>
                    <option value="creation">Créations</option>
                    <option value="cohosting">Co-hébergements</option>
                </select>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Signalé par
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Utilisateur signalé
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Raison
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Statut
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($reports as $report)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $report->reporter->getProfilePictureUrl('small') }}"
                                    alt="{{ $report->reporter->name }}"
                                    class="w-9 h-9 rounded-full object-cover">
                                <p class="text-sm font-medium text-gray-900">{{ $report->reporter->name }}</p>
                            </div>
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $report->reportedUser->getProfilePictureUrl('small') }}"
                                    alt="{{ $report->reportedUser->name }}"
                                    class="w-9 h-9 rounded-full object-cover">
                                <p class="text-sm font-medium text-gray-900">{{ $report->reportedUser->name }}</p>
                            </div>
                        </td>

                        <td class="px-6 py-3">
                            @php
                                $type = class_basename($report->reportable_type);
                                $typeColors = [
                                    'Creation' => 'bg-blue-100 text-blue-800',
                                    'CoHosting' => 'bg-green-100 text-green-800',
                                ];
                            @endphp
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium {{ $typeColors[$type] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $type === 'Creation' ? 'Création' : 'Co-hébergement' }}
                                </span>
                        </td>

                        <td class="px-6 py-3">
                            <p class="text-sm text-gray-900">{{ $report->reason->label() }}</p>
                        </td>

                        <td class="px-6 py-3">
                            @if($report->status === 'pending')
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        En attente
                                    </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Traité
                                    </span>
                            @endif
                        </td>

                        <td class="px-6 py-3 text-xs text-gray-600">
                            {{ $report->created_at->format('d/m/Y H:i') }}
                        </td>

                        <td class="px-6 py-3">
                            <div class="flex items-center gap-2">
                                @if($report->reportable)
                                    @if($type === 'Creation')
                                        <button
                                            wire:click="$dispatch('openModal', { component: 'creations.show', size: 'large', creationId: {{ $report->reportable_id }} })"
                                            class="px-3 py-1.5 bg-[var(--color-pink-700)] text-white rounded-lg text-xs hover:bg-[var(--color-pink-900)] transition">
                                            Voir
                                        </button>
                                    @elseif($type === 'CoHosting')
                                        <button
                                            wire:click="$dispatch('openModal', { component: 'cohosting.show', size: 'large', coHostingId: {{ $report->reportable_id }} })"
                                            class="px-3 py-1.5 bg-[var(--color-pink-700)] text-white rounded-lg text-xs hover:bg-[var(--color-pink-900)] transition">
                                            Voir
                                        </button>
                                    @endif
                                @else
                                    <button
                                        wire:click="$dispatch('alert', { type: 'error', message: 'Cette publication a été supprimée par un modérateur.' })"
                                        class="px-3 py-1.5 bg-gray-400 text-white rounded-lg text-xs cursor-not-allowed">
                                        Supprimé
                                    </button>
                                @endif

                                @if($report->status === 'pending')
                                    <button
                                        wire:click="markAsResolved({{ $report->id }})"
                                        class="px-3 py-1.5 bg-green-600 text-white rounded-lg text-xs hover:bg-green-700 transition">
                                        Traiter
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-500">
                                <x-icons.warning class="w-12 h-12"></x-icons.warning>
                                <p class="text-lg">Aucun signalement trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $reports->links() }}
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Total signalements</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $reports->total() }}</p>
                </div>
                <div
                    class="w-11 h-11 bg-[var(--color-pink-100)] rounded-xl flex items-center justify-center text-[var(--color-primary)]">
                    <x-icons.warning></x-icons.warning>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">En attente</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Report::where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600">
                    <x-icons.clock></x-icons.clock>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Traités</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\Report::where('status', 'resolved')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center text-green-600">
                    <x-icons.check></x-icons.check>
                </div>
            </div>
        </div>
    </div>
    @livewire('components.modal')
</div>
