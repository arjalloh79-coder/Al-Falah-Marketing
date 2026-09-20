@extends('User.main')

@section('title', 'Client Dashboard - Al-Falah Digital Marketing')

@section('main-section')
<div class="min-h-screen bg-muted pt-20 flex">

    <!-- Include your decoupled sidebar module architecture -->
    @include('User.sidebar')

    <!-- Primary Layout Body Workspace Panel Grid Space Wrap Box Container Elements -->
    <div class="flex-1 lg:pl-64 min-w-0 transition-all duration-300">
        <div class="p-4 sm:p-6 lg:p-8">
            
            <!-- Mobile Control Top Bar Ribbon panel line layout wrapper -->
            <div class="flex items-center justify-between mb-6 lg:hidden bg-white p-4 rounded-xl border border-gray-200">
                <span class="text-sm font-bold text-dark uppercase tracking-wider">Dashboard Navigation</span>
                <button onclick="toggleDashboardSidebar()" class="w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Welcome Greeting Module Element Row Grid Header Area -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-dark tracking-tighter mb-2">Welcome Back, {{ Auth::user()->name }}!</h1>
                <p class="text-gray-500 text-sm md:text-base">Here is what is happening across your marketing campaigns and systems right now.</p>
            </div>

            <!-- Metrics Statistics Counter Grid Area Deck blocks panel summary section -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Statistic Block item 1 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-2xl">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Orders Placed</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $orders->count() }}</h3>
                    </div>
                </div>

                <!-- Statistic Block item 2 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary text-2xl">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Consultations Booked</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $consultations->count() }}</h3>
                    </div>
                </div>

                <!-- Statistic Block item 3 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center text-accent text-2xl">
                        <i class="fas fa-spinner"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Orders In Progress</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $orders->whereIn('status', ['confirmed', 'in_progress'])->count() }}</h3>
                    </div>
                </div>

                <!-- Statistic Block item 4 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-500 text-2xl">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Completed Orders</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">{{ $orders->where('status', 'completed')->count() }}</h3>
                    </div>
                </div>
            </div>

            <!-- Two-Column Context Data Board Row Split -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- Recent Activity Table Card element -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 xl:col-span-2">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-muted">
                        <h3 class="text-lg font-bold text-dark uppercase tracking-wider">Recent Activity</h3>
                    </div>
                    <div class="space-y-4">
                        @forelse ($recentActivity as $item)
                            <div class="p-4 bg-muted rounded-xl flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <i class="fas {{ $item['icon'] }} text-primary text-xl"></i>
                                    <div>
                                        <h4 class="text-sm font-bold text-dark">{{ $item['title'] }}</h4>
                                        <p class="text-xs text-gray-500">{{ $item['subtitle'] }}</p>
                                    </div>
                                </div>
                                <span @class([
                                    'text-xs font-bold uppercase tracking-wider px-3 py-1 rounded',
                                    'text-amber-600 bg-amber-100' => $item['status'] === 'pending',
                                    'text-secondary bg-secondary/10' => in_array($item['status'], ['confirmed', 'completed']),
                                    'text-primary bg-primary/10' => $item['status'] === 'in_progress',
                                    'text-red-600 bg-red-100' => $item['status'] === 'cancelled',
                                ])>{{ ucfirst(str_replace('_', ' ', $item['status'])) }}</span>
                            </div>
                        @empty
                            <div class="p-6 text-center">
                                <p class="text-sm text-gray-500">No orders or consultations yet.</p>
                                <a href="/#consultation-form" class="text-primary font-bold text-sm hover:underline">Book a consultation</a> to get started.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Strategy Team / Consultations Side widget element card -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100">
                    <div class="mb-6 pb-4 border-b border-muted">
                        <h3 class="text-lg font-bold text-dark uppercase tracking-wider">Your Accounts Strategy Lead</h3>
                    </div>
                    <div class="text-center py-4">
                        <div class="w-20 h-20 bg-primary text-white text-3xl font-bold rounded-full mx-auto mb-4 flex items-center justify-center">AF</div>
                        <h4 class="text-md font-bold text-dark">Al-Falah Strategy Core</h4>
                        <p class="text-xs text-gray-500">Premium Digital Implementation Partner</p>
                        
                        <div class="mt-6 pt-6 border-t border-muted space-y-3">
                            <a href="/#consultation-form" class="w-full h-12 bg-primary text-white rounded-lg font-bold text-xs uppercase tracking-widest flex items-center justify-center transition-colors hover:bg-blue-600">
                                <i class="fas fa-video mr-2"></i> Book Next Session
                            </a>
                            <a href="{{ \App\Support\Contact::whatsappUrl() }}" target="_blank" class="w-full h-12 border-2 border-muted text-dark hover:border-primary rounded-lg font-bold text-xs uppercase tracking-widest flex items-center justify-center transition-colors">
                                <i class="fab fa-whatsapp text-secondary mr-2 text-base"></i> Direct Message Team
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    // Handles Mobile Responsive Open and Close State Matrix Transformations
    function toggleDashboardSidebar() {
        const sidebar = document.getElementById('dashboardSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
        }
    }
</script>
@endsection