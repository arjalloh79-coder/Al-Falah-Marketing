@extends('User.main')

@section('title', 'Login - Al-Falah Digital Marketing')

@section('main-section')

<section class="relative bg-primary pt-24 pb-16 md:pt-32 md:pb-20 overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tighter leading-tight">
            Welcome <span class="text-accent">Back.</span>
        </h1>
        <p class="text-base text-white/90 max-w-xl mx-auto leading-relaxed">
            Log in to manage your campaigns, review project metrics, and sync with your dedicated strategy team.
        </p>
    </div>
</section>

<section class="py-12 md:py-20 bg-muted relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                
                <div class="md:col-span-2 bg-accent p-8 text-white flex flex-col justify-between">
                    <div>
                        <h3 class="text-3xl font-bold mb-6">Client Portal</h3>
                        <p class="mb-8 text-white/80">Access your digital growth systems, real-time lead analytics, and automated dashboards instantly.</p>
                    </div>
                    <ul class="space-y-4 hidden md:block">
                        <li class="flex items-center"><i class="fas fa-shield-alt mr-3 text-white/70"></i> Secure Session</li>
                        <li class="flex items-center"><i class="fas fa-chart-line mr-3 text-white/70"></i> Live ROI Tracking</li>
                        <li class="flex items-center"><i class="fas fa-headset mr-3 text-white/70"></i> 24/7 Priority Support</li>
                    </ul>
                </div>

                <div class="md:col-span-3 p-8 lg:p-12">
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('status'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Action points to route implementation -->
                    <form action="{{ route('login.perform') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Email Address</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Password</label>
                            <input type="password" name="password" required class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="••••••••">
                        </div>

                        <div class="flex items-center justify-between text-sm pt-2">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-2 border-gray-300 text-primary focus:ring-0">
                                <span class="ml-2 text-gray-500 font-semibold">Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}" class="text-primary font-bold hover:text-blue-700 transition-colors">Forgot?</a>
                        </div>

                        <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02] shadow-md">
                            Confirm Login
                        </button>
                    </form>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p class="text-gray-500 text-sm">
                            Besoin d'un accès ? <a href="{{ \App\Support\Contact::whatsappUrl("Bonjour Al-Falah, je souhaite un accès à mon espace client.") }}" target="_blank" rel="noopener" class="text-primary font-bold hover:text-blue-700 transition-colors">Contactez-nous sur WhatsApp</a>
                            <span class="block mt-1 text-gray-400">Need access? Message us on WhatsApp.</span>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection