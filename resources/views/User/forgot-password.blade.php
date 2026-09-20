@extends('User.main')

@section('title', 'Forgot Password - Al-Falah Digital Marketing')

@section('main-section')

<section class="relative bg-primary pt-24 pb-16 md:pt-32 md:pb-20 overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tighter leading-tight">
            Reset Your <span class="text-accent">Password.</span>
        </h1>
        <p class="text-base text-white/90 max-w-xl mx-auto leading-relaxed">
            Enter your account email and we'll send you a link to choose a new password.
        </p>
    </div>
</section>

<section class="py-12 md:py-20 bg-muted relative overflow-hidden">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden p-8 lg:p-12">

            @if (session('status'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-bold text-dark mb-1 uppercase tracking-wider">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="email@example.com">
                </div>

                <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02] shadow-md">
                    Send Reset Link
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-gray-500 text-sm">
                    Remembered it after all? <a href="{{ route('login') }}" class="text-primary font-bold hover:text-blue-700 transition-colors">Back to Login</a>
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
