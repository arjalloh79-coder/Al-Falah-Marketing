@extends('User.main')

@section('title', 'Create Account - Al-Falah Digital Marketing')

@section('main-section')

<section class="relative bg-primary pt-24 pb-16 md:pt-32 md:pb-20 overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tighter leading-tight">
            Start Your <span class="text-accent">Success Story.</span>
        </h1>
        <p class="text-base text-white/90 max-w-xl mx-auto leading-relaxed">
            Create your profile today and connect your brand with data-backed marketing systems built to optimize conversion.
        </p>
    </div>
</section>

<section class="py-12 md:py-20 bg-muted relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                
                <div class="md:col-span-2 bg-accent p-8 text-white flex flex-col justify-between">
                    <div>
                        <h3 class="text-3xl font-bold mb-6">Join Al-Falah</h3>
                        <p class="mb-8 text-white/80">Deploy custom solutions for your audience across the USA, Africa, and beyond.</p>
                    </div>
                    <ul class="space-y-4 hidden md:block">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3 text-white/70"></i> Custom Strategy Access</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3 text-white/70"></i> Competitor Audits</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3 text-white/70"></i> Performance Scaling</li>
                    </ul>
                </div>

                <div class="md:col-span-3 p-8 lg:p-12">
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm">
                            <ul class="list-disc pl-4">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Action points to route implementation -->
                    <form action="{{ route('signup.perform') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Full Name</label>
                            <input type="text" name="name" required value="{{ old('name') }}" class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="John Doe">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Email Address</label>
                            <input type="email" name="email" required value="{{ old('email') }}" class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Password</label>
                            <input type="password" name="password" required class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="••••••••">
                        </div>

                        <div class="flex items-start pt-2">
                            <input type="checkbox" required class="w-4 h-4 mt-1 rounded border-2 border-gray-300 text-primary focus:ring-0 cursor-pointer">
                            <span class="ml-2 text-sm text-gray-500 font-semibold">I agree to the Terms of Service and Privacy Policy</span>
                        </div>

                        <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02] shadow-md">
                            Register Account
                        </button>
                    </form>
                    
                    <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                        <p class="text-gray-500 text-sm">
                            Already have an account? <a href="{{ route('login') }}" class="text-primary font-bold hover:text-blue-700 transition-colors">Login Here</a>
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

@endsection