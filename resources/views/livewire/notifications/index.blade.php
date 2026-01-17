<main class="min-h-screen py-4 md:py-8">
    <div class="max-w-4xl mx-auto px-4 md:px-0">
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header -->
            <header class="border-b border-gray-100 px-4 md:px-6 py-4 md:py-5">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Notifications</h1>

                    <div aria-label="Actions sur les notifications" class="flex gap-2">
                        @if($unreadCount > 0)
                            <button
                                wire:click="markAllAsRead"
                                class="text-xs md:text-sm text-[var(--color-primary)] hover:text-[var(--color-pink-900)] font-medium transition-colors px-3 py-1.5 hover:bg-[var(--color-pink-50)] rounded-lg"
                                aria-label="Marquer toutes les notifications comme lues">
                                <span class="hidden sm:inline">Tout marquer comme lu</span>
                                <span class="sm:hidden">Marquer tout</span>
                            </button>
                        @endif
                        <button
                            wire:click="$dispatch('openModal', { component: 'notifications.delete-all-confirmation', size: 'medium' })"
                            class="text-xs md:text-sm text-red-600 hover:text-red-700 font-medium transition-colors px-3 py-1.5 hover:bg-red-50 rounded-lg"
                            aria-label="Supprimer toutes les notifications">
                            <span class="hidden sm:inline">Tout supprimer</span>
                            <span class="sm:hidden">Supprimer</span>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Filtres -->
            <div aria-label="Filtres de notifications" class="border-b border-gray-100 px-4 md:px-6 py-3 md:py-4">
                <ul class="flex gap-2 overflow-x-auto">
                    <li>
                        <button
                            wire:click="setFilter('all')"
                            class="px-3 md:px-4 py-2 rounded-full text-xs md:text-sm font-medium transition-colors whitespace-nowrap {{ $filter === 'all' ? 'bg-[var(--color-pink-700)] text-white' : 'text-gray-600 hover:bg-gray-100' }}"
                            aria-pressed="{{ $filter === 'all' ? 'true' : 'false' }}"
                            aria-label="Afficher toutes les notifications">
                            Toutes <span aria-hidden="true">({{ $notifications->total() }})</span>
                        </button>
                    </li>
                    <li>
                        <button
                            wire:click="setFilter('unread')"
                            class="px-3 md:px-4 py-2 rounded-full text-xs md:text-sm font-medium transition-colors whitespace-nowrap {{ $filter === 'unread' ? 'bg-[var(--color-pink-700)] text-white' : 'text-gray-600 hover:bg-gray-100' }}"
                            aria-pressed="{{ $filter === 'unread' ? 'true' : 'false' }}"
                            aria-label="Afficher les notifications non lues">
                            Non lues <span aria-hidden="true">({{ $unreadCount }})</span>
                        </button>
                    </li>
                    <li>
                        <button
                            wire:click="setFilter('read')"
                            class="px-3 md:px-4 py-2 rounded-full text-xs md:text-sm font-medium transition-colors whitespace-nowrap {{ $filter === 'read' ? 'bg-[var(--color-pink-700)] text-white' : 'text-gray-600 hover:bg-gray-100' }}"
                            aria-pressed="{{ $filter === 'read' ? 'true' : 'false' }}"
                            aria-label="Afficher les notifications lues">
                            Lues
                        </button>
                    </li>
                </ul>
            </div>

            <!-- Liste des notifications -->
            <div aria-label="Liste des notifications">
                <ul class="divide-y divide-gray-100">
                    @foreach($notifications as $notification)
                        <li class="px-4 md:px-6 py-3 md:py-4 hover:bg-gray-50 transition-colors {{ !$notification->is_read ? 'bg-[var(--color-pink-50)]' : '' }}"
                            aria-label="{{ $notification->is_read ? 'Notification lue' : 'Notification non lue' }}">
                            <div class="flex items-start gap-3 md:gap-4">
                                <!-- Icône selon le type -->
                                <div class="mt-1 flex-shrink-0" aria-hidden="true">
                                    @if($notification->type === 'like')
                                        <div
                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 text-red-500" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                            </svg>
                                        </div>
                                    @elseif($notification->type === 'comment')
                                        <div
                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-500" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5zm3.293 1.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 01-1.414-1.414L7.586 10 5.293 7.707a1 1 0 010-1.414zM11 12a1 1 0 100 2h3a1 1 0 100-2h-3z"/>
                                            </svg>
                                        </div>
                                    @elseif($notification->type === 'follow')
                                        <div
                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-green-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 text-green-500" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                            </svg>
                                        </div>
                                    @elseif($notification->type === 'live_started')
                                        <div
                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-purple-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 text-purple-500" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path
                                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                            </svg>
                                        </div>
                                    @elseif($notification->type === 'deletion')
                                        <div
                                            class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-red-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 md:w-5 md:h-5 text-red-500" fill="currentColor"
                                                 viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                      clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <!-- Contenu -->
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs md:text-sm {{ !$notification->is_read ? 'font-semibold text-gray-900' : 'text-gray-700' }} leading-relaxed">
                                        {{ $notification->getMessage() }}
                                    </p>
                                    <time datetime="{{ $notification->created_at->toIso8601String() }}"
                                          class="text-[10px] md:text-xs text-gray-500 mt-1 md:mt-2 block">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </time>
                                </div>

                                <!-- Actions -->
                                <div aria-label="Actions de la notification"
                                     class="flex items-center gap-1 md:gap-2 flex-shrink-0">
                                    @if(!$notification->is_read)
                                        <button
                                            wire:click="markAsRead({{ $notification->id }})"
                                            class="p-1.5 md:p-2 text-[var(--color-primary)] hover:bg-[var(--color-pink-100)] rounded-lg transition-colors"
                                            aria-label="Marquer cette notification comme lue">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    @else
                                        <button
                                            wire:click="markAsUnread({{ $notification->id }})"
                                            class="p-1.5 md:p-2 text-gray-400 hover:bg-gray-100 rounded-lg transition-colors"
                                            aria-label="Marquer cette notification comme non lue">
                                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </button>
                                    @endif

                                    <button
                                        wire:click="delete({{ $notification->id }})"
                                        class="p-1.5 md:p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        aria-label="Supprimer cette notification">
                                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                @if($notifications->isEmpty())
                    <div class="px-4 md:px-6 py-12 text-center flex flex-col items-center justify-center gap-4"
                         role="status">
                        <x-icons.notify class="w-12 h-12 text-gray-400" aria-hidden="true"></x-icons.notify>
                        <p class="text-sm text-gray-500">Aucune notification</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <nav aria-label="Pagination des notifications" class="px-4 md:px-6 py-4 border-t border-gray-100">
                    {{ $notifications->links() }}
                </nav>
            @endif
        </section>
    </div>
    @livewire('components.modal')
    @livewire('components.alert')
</main>
