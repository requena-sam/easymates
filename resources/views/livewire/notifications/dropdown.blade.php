<div x-data="{ dropdownOpen: false }"
     @click.away="dropdownOpen = false"
     class="relative h-11">

    <button @click="dropdownOpen = !dropdownOpen"
            class="relative flex items-center justify-center bg-white rounded-full w-11 h-11 hover:bg-gray-100 transition-colors duration-150">
        <x-icons.notify></x-icons.notify>

        @if($unreadCount > 0)
            <span
                class="absolute -top-1 -right-1 bg-[var(--color-primary)] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <div x-show="dropdownOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed left-1/2 -translate-x-1/2 top-24 w-[95vw] bg-white rounded-2xl shadow-xl z-9999 overflow-hidden border border-gray-100 sm:absolute sm:top-auto sm:left-auto sm:translate-x-0 sm:right-0 sm:mt-3 sm:w-96">

        <div class="flex items-center justify-between px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-100">
            <h3 class="text-base sm:text-lg font-semibold text-gray-900">Notifications</h3>
            @if($unreadCount > 0)
                <button wire:click="markAllAsRead"
                        class="text-xs sm:text-sm text-[var(--color-primary)] hover:text-[var(--color-pink-900)] font-medium transition-colors whitespace-nowrap">
                    Tout marquer comme lu
                </button>
            @endif
        </div>

        <div class="max-h-[28rem] overflow-y-auto">
            @foreach($notifications as $notification)
                <div
                    class="px-4 sm:px-5 py-3 sm:py-4 hover:bg-gray-50 transition-colors {{ !$notification->is_read ? 'bg-[var(--color-pink-50)]' : '' }} border-b border-gray-100 last:border-b-0">
                    <div class="flex items-start gap-2 sm:gap-3">
                        <div class="flex-shrink-0 mt-0.5">
                            @if($notification->type === 'like')
                                <div
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-red-100 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-red-500" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'comment')
                                <div
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-blue-500" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'follow')
                                <div
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-green-100 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-green-500" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'live_started')
                                <div
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-purple-100 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-purple-500" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path
                                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                    </svg>
                                </div>
                            @elseif($notification->type === 'deletion')
                                <div
                                    class="w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-orange-100 flex items-center justify-center">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4 text-orange-600" fill="currentColor"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1 min-w-0">
                            <p class="text-xs sm:text-sm {{ !$notification->is_read ? 'font-semibold text-gray-900' : 'text-gray-700' }} leading-relaxed break-words">
                                {{ $notification->getMessage() }}
                            </p>
                            <p class="text-[10px] sm:text-xs text-gray-500 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="flex flex-col gap-1 flex-shrink-0">
                            @if(!$notification->is_read)
                                <button wire:click="markAsRead({{ $notification->id }})"
                                        class="p-1 text-[var(--color-primary)] hover:bg-[var(--color-pink-100)] rounded-lg transition-colors"
                                        title="Marquer comme lu">
                                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5 13l4 4L19 7"/>
                                    </svg>
                                </button>
                            @endif

                            <button wire:click="delete({{ $notification->id }})"
                                    class="p-1 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    title="Supprimer">
                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(count($notifications) === 0)
                <div class="px-4 sm:px-6 py-12 sm:py-16 text-center">
                    <svg class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-3 sm:mb-4 text-gray-300" fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <p class="text-gray-500 text-sm sm:text-base">Aucune notification</p>
                </div>
            @endif
        </div>

        @if(count($notifications) >= 5)
            <div class="px-4 sm:px-5 py-2.5 sm:py-3 border-t border-gray-100 bg-gray-50">
                <a href="{{ route('notifications') }}"
                   class="block text-center text-xs sm:text-sm text-[var(--color-primary)] hover:text-[var(--color-pink-900)] font-medium transition-colors">
                    Voir toutes les notifications
                </a>
            </div>
        @endif
    </div>
</div>
