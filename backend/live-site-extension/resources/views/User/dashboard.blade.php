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
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Traffic Conversions</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">12,450</h3>
                    </div>
                </div>

                <!-- Statistic Block item 2 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center text-secondary text-2xl">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Active Leads Generated</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">+342</h3>
                    </div>
                </div>

                <!-- Statistic Block item 3 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-accent/10 rounded-xl flex items-center justify-center text-accent text-2xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Strategy Hours Tracked</p>
                        <h3 class="text-2xl font-bold text-dark mt-1">18.5 hrs</h3>
                    </div>
                </div>

                <!-- Statistic Block item 4 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 flex items-center space-x-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center text-purple-500 text-2xl">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Project System Status</p>
                        <h3 class="text-xl font-bold text-secondary mt-1">Active / Live</h3>
                    </div>
                </div>
            </div>

            <!-- Two-Column Context Data Board Row Split -->
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <!-- Project Status Task Monitoring Table Card element -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 xl:col-span-2">
                    <div class="flex items-center justify-between mb-6 pb-4 border-b border-muted">
                        <h3 class="text-lg font-bold text-dark uppercase tracking-wider">Ongoing System Milestones</h3>
                        <span class="text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded">Updated Live</span>
                    </div>
                    <div class="space-y-4">
                        <div class="p-4 bg-muted rounded-xl flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-laptop-code text-primary text-xl"></i>
                                <div>
                                    <h4 class="text-sm font-bold text-dark">Landing Page Copywriting & UI Tweaks</h4>
                                    <p class="text-xs text-gray-500">Web Architecture & Conversion Optimization System</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-accent bg-accent/10 px-3 py-1 rounded">In Review</span>
                        </div>

                        <div class="p-4 bg-muted rounded-xl flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-search text-secondary text-xl"></i>
                                <div>
                                    <h4 class="text-sm font-bold text-dark">SEO Schema Optimization & Backlinking Setup</h4>
                                    <p class="text-xs text-gray-500">Organic Growth Campaign Development System</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-secondary bg-secondary/10 px-3 py-1 rounded">Completed</span>
                        </div>

                        <div class="p-4 bg-muted rounded-xl flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-robot text-purple-500 text-xl"></i>
                                <div>
                                    <h4 class="text-sm font-bold text-dark">AI Lead Routing Automation Engine Connection</h4>
                                    <p class="text-xs text-gray-500">AI Automation Workflow Integrations</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-primary bg-primary/10 px-3 py-1 rounded">In Progress</span>
                        </div>
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
                            <a href="https://wa.me/YOUR_NUMBER" target="_blank" class="w-full h-12 border-2 border-muted text-dark hover:border-primary rounded-lg font-bold text-xs uppercase tracking-widest flex items-center justify-center transition-colors">
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