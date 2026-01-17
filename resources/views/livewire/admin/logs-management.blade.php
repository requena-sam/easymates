<div class="space-y-6">
    <section class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">
        <h2 class="sr-only">{{__('Filters section')}}</h2>
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div class="relative flex-1 max-w-md">
                <input
                    type="text"
                    wire:model.live.debounce.100ms="search"
                    placeholder="Rechercher par nom de staff..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <x-icons.search></x-icons.search>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-600">Type:</label>
                <select
                    wire:model.live="typeFilter"
                    class="pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white">
                    <option value="all">Tous</option>
                    <option value="deletion">Suppressions</option>
                    <option value="report">Signalements</option>
                    <option value="user_role">Rôles utilisateurs</option>
                </select>
            </div>

            <div class="flex items-center gap-2">
                <label class="text-xs font-medium text-gray-600">Staff:</label>
                <select
                    wire:model.live="staffFilter"
                    class="pl-3 pr-8 py-2 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[var(--color-pink-700)] focus:border-transparent transition appearance-none bg-white">
                    <option value="all">Tous</option>
                    @foreach($staffMembers as $staff)
                        <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <h2 class="sr-only">{{__('Logs Table')}}</h2>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Staff
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Action
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Raison
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Date
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $log->staff->getProfilePictureUrl('small') }}"
                                    alt="{{ $log->staff->name }}"
                                    class="w-9 h-9 rounded-full object-cover">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $log->staff->name }}</p>
                                    @php
                                        $staffRole = $log->staff->roles->first();
                                        $roleColors = [
                                            'admin' => 'bg-purple-100 text-purple-800',
                                            'moderator' => 'bg-blue-100 text-blue-800',
                                        ];
                                    @endphp
                                    @if($staffRole)
                                        <span
                                            class="px-1.5 py-0.5 rounded text-xs font-medium {{ $roleColors[$staffRole->name] ?? '' }}">
                                            {{ ucfirst($staffRole->name) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-3">
                            @php
                                $typeColors = [
                                    'deletion' => 'bg-red-100 text-red-800',
                                    'report' => 'bg-yellow-100 text-yellow-800',
                                    'user_role' => 'bg-blue-100 text-blue-800',
                                ];
                                $typeLabels = [
                                    'deletion' => 'Suppression',
                                    'report' => 'Signalement',
                                    'user_role' => 'Rôle',
                                ];
                            @endphp
                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-medium {{ $typeColors[$log->type->value] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $typeLabels[$log->type->value] ?? $log->type->value }}
                            </span>
                        </td>

                        <td class="px-6 py-3">
                            <p class="text-sm text-gray-900">{{ $log->getMessage() }}</p>

                            @if($log->metadata)
                                <details class="mt-1">
                                    <summary class="text-xs text-gray-500 cursor-pointer hover:text-gray-700">
                                        Voir détails
                                    </summary>
                                    <div class="mt-2 p-2 bg-gray-50 rounded text-xs text-gray-600 space-y-1">
                                        @foreach($log->getFormattedMetadata() as $key => $value)
                                            <div>
                                                <span
                                                    class="font-medium">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                                                <span>{{ is_array($value) ? json_encode($value) : $value }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </details>
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            @if($log->reason)
                                <p class="text-sm text-gray-600 max-w-xs truncate" title="{{ $log->reason }}">
                                    {{ $log->reason }}
                                </p>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="px-6 py-3">
                            <div class="text-xs text-gray-600">
                                <div>{{ $log->created_at->format('d/m/Y') }}</div>
                                <div class="text-gray-400">{{ $log->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <x-icons.sheet class="w-10 h-10"></x-icons.sheet>
                                <p class="text-gray-500 text-lg">Aucun log trouvé</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $logs->links() }}
            </div>
        @endif
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Total logs</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $logs->total() }}</p>
                </div>
                <div
                    class="w-11 h-11 bg-[var(--color-pink-100)] rounded-xl flex items-center justify-center text-[var(--color-primary)]">
                    <x-icons.sheet></x-icons.sheet>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Suppressions</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\ModerationLog::where('type', 'deletion')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                    <x-icons.delete strokeWidth="2"></x-icons.delete>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-600 mb-1">Signalements traités</p>
                    <p class="text-2xl font-bold text-gray-900">{{ \App\Models\ModerationLog::where('type', 'report')->count() }}</p>
                </div>
                <div class="w-11 h-11 bg-yellow-100 rounded-xl flex items-center justify-center text-yellow-600">
                    <x-icons.warning></x-icons.warning>
                </div>
            </div>
        </div>
    </div>
</div>
