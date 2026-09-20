<header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
    <div class="flex items-center">
        <!-- Mobile Toggle Button -->
        <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Search Bar (Desktop) -->
        <div class="relative mx-4 lg:mx-0 hidden sm:block">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                <i class="fas fa-search text-gray-400"></i>
            </span>
            <input class="w-32 pl-10 pr-4 rounded-lg form-input sm:w-64 focus:border-blue-500 bg-gray-100 border-none h-10 text-sm" type="text" placeholder="Search data...">
        </div>
    </div>

    <div class="flex items-center space-x-4">
        <button class="flex text-gray-400 hover:text-gray-600 focus:outline-none">
            <i class="fas fa-bell"></i>
        </button>
        
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