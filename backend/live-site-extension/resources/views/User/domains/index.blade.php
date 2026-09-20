@extends('User.main')

@section('main-section')

<!-- 1. Sidebar Include -->
@include('User.sidebar')

<!-- 2. Main Content Wrapper -->
<!-- Added "lg:ml-64" to push content to the right when sidebar is visible on desktop -->
<div class="transition-all duration-300 lg:ml-64 pt-32 pb-20 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Mobile Toggle Button (Visible only on mobile if sidebar is hidden) -->
        <button onclick="toggleDashboardSidebar()" class="lg:hidden mb-4 flex items-center text-primary font-bold">
            <i class="fas fa-bars mr-2"></i> Menu
        </button>

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-dark tracking-tight">My Domains</h1>
            <p class="text-gray-600">Track your active services and domain expiry dates.</p>
        </div>

        @if($domains->isEmpty())
            <div class="bg-white p-12 rounded-2xl shadow-sm text-center border border-gray-100">
                <div class="w-20 h-20 bg-muted rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-globe text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-dark mb-2">No Domains Found</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-8">You don't have any domains registered in our system yet. Contact us to link your domain.</p>
                <a href="https://wa.me/YOUR_NUMBER" class="inline-flex items-center px-6 py-3 bg-primary text-white rounded-lg font-bold transition hover:scale-105">
                    Contact Support
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($domains as $domain)
                    @php
                        $expiry = \Carbon\Carbon::parse($domain->end_date);
                        $daysLeft = \Carbon\Carbon::today()->diffInDays($expiry, false);
                    @endphp
                    
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-link text-primary"></i>
                                </div>
                                
                                @if($daysLeft < 0)
                                    <span class="px-3 py-1 bg-red-100 text-red-600 text-xs font-bold rounded-full">Expired</span>
                                @elseif($daysLeft <= 30)
                                    <span class="px-3 py-1 bg-amber-100 text-amber-600 text-xs font-bold rounded-full animate-pulse">Expiring Soon</span>
                                @else
                                    <span class="px-3 py-1 bg-green-100 text-green-600 text-xs font-bold rounded-full">Active</span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-dark mb-1">{{ $domain->domain_name }}</h3>
                            <p class="text-sm text-gray-500 mb-6 font-mono">ID: DOM-{{ str_pad($domain->id, 5, '0', STR_PAD_LEFT) }}</p>

                            <div class="space-y-3 border-t border-gray-50 pt-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Registration Date:</span>
                                    <span class="text-dark font-semibold">{{ date('M d, Y', strtotime($domain->start_date)) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Expiry Date:</span>
                                    <span class="text-dark font-semibold">{{ date('M d, Y', strtotime($domain->end_date)) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                                @if($daysLeft >= 0)
                                    {{ $daysLeft }} Days Remaining
                                @else
                                    Lapsed
                                @endif
                            </span>
                            <a href="https://wa.me/YOUR_NUMBER?text=Query regarding domain {{ $domain->domain_name }}" class="text-primary text-sm font-bold hover:underline">
                                Help <i class="fas fa-chevron-right text-[10px] ml-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection

@section('scripts')
<script>
    function toggleDashboardSidebar() {
        const sidebar = document.getElementById('dashboardSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            if(backdrop) backdrop.classList.remove('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            if(backdrop) backdrop.classList.add('hidden');
        }
    }
</script>
@endsection