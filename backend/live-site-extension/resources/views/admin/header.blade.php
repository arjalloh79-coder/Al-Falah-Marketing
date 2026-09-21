<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
    <div class="flex items-center">
        <!-- Mobile Toggle Button -->
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Search Bar (Desktop) -->
        <form action="{{ route('admin.search') }}" method="GET" class="relative mx-4 lg:mx-0 hidden sm:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input type="text" name="q" value="{{ request('q') }}" class="w-32 pl-10 pr-4 rounded-lg form-input sm:w-64 focus:border-blue-500 bg-gray-100 border-none h-10 text-sm" placeholder="Search data...">
        </form>
    </div>

    <div class="flex items-center space-x-4">
        <div x-data="{ notifOpen: false }" class="relative">
            <button @click="notifOpen = !notifOpen" class="relative flex text-gray-400 hover:text-gray-600 focus:outline-none">
                <i class="fas fa-bell"></i>
                @if ($unreadNotificationsCount > 0)
                    <span class="absolute -top-1.5 -right-1.5 flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 rounded-full">
                        {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                    </span>
                @endif
            </button>

            <div x-show="notifOpen" @click.away="notifOpen = false" class="absolute right-0 z-10 w-80 mt-2 bg-white rounded-md shadow-xl border border-gray-100" x-cloak>
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
                    <span class="text-sm font-bold text-gray-700">Notifications</span>
                    @if ($unreadNotificationsCount > 0)
                        <form action="{{ route('admin.notifications.read-all') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-primary hover:underline">Mark all read</button>
                        </form>
                    @endif
                </div>

                <div class="max-h-80 overflow-y-auto divide-y divide-gray-100">
                    @forelse ($recentNotifications as $n)
                        <form action="{{ route('admin.notifications.read', $n->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-3 hover:bg-gray-50 flex items-start gap-2">
                                @if (!$n->read_at)
                                    <span class="mt-1.5 w-2 h-2 rounded-full bg-primary flex-shrink-0"></span>
                                @else
                                    <span class="mt-1.5 w-2 h-2 rounded-full bg-transparent flex-shrink-0"></span>
                                @endif
                                <span class="min-w-0">
                                    <span class="block text-sm {{ $n->read_at ? 'text-gray-500' : 'font-bold text-gray-800' }}">{{ $n->title }}</span>
                                    <span class="block text-xs text-gray-500 truncate">{{ $n->body }}</span>
                                    <span class="block text-[10px] text-gray-400 mt-0.5">{{ $n->created_at->diffForHumans() }}</span>
                                </span>
                            </button>
                        </form>
                    @empty
                        <p class="px-4 py-6 text-sm text-gray-400 text-center">No notifications yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div x-data="{ dropdownOpen: false }" class="relative">
            <button @click="dropdownOpen = !dropdownOpen" class="flex items-center focus:outline-none">
                <img class="object-cover w-8 h-8 rounded-full border-2 border-accent" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D6EFD&color=fff" alt="Avatar">
                <span class="hidden md:block ml-2 text-sm font-bold text-gray-700">{{ auth()->user()->name }}</span>
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 z-10 w-48 mt-2 bg-white rounded-md shadow-xl border border-gray-100" x-cloak>
                <a href="{{ route('admin.profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-600 hover:text-white">My Profile</a>
                <a href="{{ route('admin.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-600 hover:text-white">Settings</a>
            </div>
        </div>
    </div>
</header>