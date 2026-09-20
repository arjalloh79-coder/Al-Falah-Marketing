<!-- Sidebar Navigation View Component -->
<aside id="dashboardSidebar"
    class="fixed top-20 left-0 h-[calc(100vh-5rem)] w-64 bg-white border-r-2 border-muted z-30 transition-transform duration-300 transform -translate-x-full lg:translate-x-0 overflow-y-auto">
    <div class="p-6">
        <!-- Client Detail Header Profile Snapshot -->
        <div class="flex items-center space-x-3 pb-6 border-b-2 border-muted mb-6">
            <div
                class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold text-lg">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div>
                <h4 class="text-sm font-bold text-dark truncate max-w-[150px]">{{ Auth::user()->name }}</h4>
                <span class="text-xs font-semibold text-secondary uppercase tracking-wider"> Customer Dashboard </span>
            </div>
        </div>

        <!-- Sidebar Navigation Elements Links Stack -->
        <nav class="space-y-2">
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center space-x-3 px-4 py-3 bg-primary/10 text-primary rounded-lg font-bold text-sm uppercase tracking-wider transition-all">
                <i class="fas fa-th-large text-lg w-5"></i>
                <span> Overview</span>
            </a>

            <a href="{{ route('user.domains.index') }}"
                class="flex items-center justify-between px-4 py-3 {{ Request::routeIs('user.domains.*') ? 'text-primary bg-muted' : 'text-gray-500' }} hover:text-primary hover:bg-muted rounded-lg font-semibold text-sm uppercase tracking-wider transition-all">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-chart-line text-lg w-5"></i>
                    <span> Domains </span>
                </div>

                @if (auth()->user()->domains()->count() > 0)
                    <span class="bg-primary text-white text-[10px] px-2 py-0.5 rounded-full">
                        {{ auth()->user()->domains()->count() }}
                    </span>
                @endif
            </a>
            
            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-500 hover:text-primary hover:bg-muted rounded-lg font-semibold text-sm uppercase tracking-wider transition-all">
                <i class="fas fa-folder-open text-lg w-5"></i>
                <span>Project Files</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-500 hover:text-primary hover:bg-muted rounded-lg font-semibold text-sm uppercase tracking-wider transition-all">
                <i class="fas fa-calendar-check text-lg w-5"></i>
                <span>Consultations</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-500 hover:text-primary hover:bg-muted rounded-lg font-semibold text-sm uppercase tracking-wider transition-all">
                <i class="fas fa-credit-card text-lg w-5"></i>
                <span>Invoices</span>
            </a>

            <a href="#"
                class="flex items-center space-x-3 px-4 py-3 text-gray-500 hover:text-primary hover:bg-muted rounded-lg font-semibold text-sm uppercase tracking-wider transition-all">
                <i class="fas fa-user-cog text-lg w-5"></i>
                <span>Settings</span>
            </a>

            <!-- Divider Layout line element -->
            <div class="h-px bg-muted my-6"></div>

            <!-- Logout Gateway Handler Target Event Form -->
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit"
                    class="w-full flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-lg font-bold text-sm uppercase tracking-wider transition-all">
                    <i class="fas fa-sign-out-alt text-lg w-5"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </nav>
    </div>
</aside>

<!-- Backdrop Blur overlay wrapper component for active mobile drawer matrix layout state views -->
<div id="sidebarBackdrop" onclick="toggleDashboardSidebar()"
    class="fixed inset-0 bg-dark/40 z-20 hidden lg:hidden transition-opacity duration-300"></div>
