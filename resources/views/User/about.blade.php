@extends('User.main')

@section('title', 'About Us - Al-Falah Digital Marketing Agency')

@section('main-section')

<!-- BREADCRUMB/HERO SECTION -->
<section class="relative bg-primary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <!-- Decorative Background Shapes -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
            <span class="text-white font-semibold text-sm uppercase tracking-wider">Our Story</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
            Bridging the Gap Between <span class="text-accent">Vision & Reality</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            Helping small businesses in the USA and Africa compete and grow through modern digital solutions and data-driven strategies.
        </p>
    </div>
</section>

<!-- MISSION & VISION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">Who We Help</span>
                </div>
                <h2 class="text-4xl font-bold text-dark mb-6 tracking-tighter">Empowering Small Businesses Across Continents</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    At Al-Falah Marketing, we recognized a common problem: small businesses in the USA and Africa often have incredible products but lack the modern digital tools to reach their full potential.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Our mission is to solve that. We provide the same high-level digital strategy used by major corporations but tailored to the budget and scale of growing enterprises. Whether you are a local shop in New York or a startup in Freetown, we bring your brand to the global stage.
                </p>
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center space-x-2 text-dark font-bold">
                        <i class="fas fa-check-circle text-primary"></i>
                        <span>Strategy Focused</span>
                    </div>
                    <div class="flex items-center space-x-2 text-dark font-bold">
                        <i class="fas fa-check-circle text-secondary"></i>
                        <span>Result Oriented</span>
                    </div>
                    <div class="flex items-center space-x-2 text-dark font-bold">
                        <i class="fas fa-check-circle text-accent"></i>
                        <span>Global Perspective</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="{{ asset('public/assets/images/team.jpg') }}" alt="Collaborative Work" class="rounded-lg shadow-2xl w-full">
                <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-lg shadow-xl hidden md:block">
                    <p class="text-primary font-bold text-4xl">100%</p>
                    <p class="text-gray-600 text-sm uppercase font-semibold">Commitment to Growth</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">The Al-Falah Advantage</span>
            </div>
            <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">Why Al-Falah Marketing?</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Point 1 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-primary">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-hand-holding-usd text-primary text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Affordable for Small Businesses</h4>
                <p class="text-gray-600">Premium marketing solutions priced fairly. We grow when you grow, ensuring a high ROI for every dollar spent.</p>
            </div>

            <!-- Point 2 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-secondary">
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-globe-africa text-secondary text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">USA & Africa Experience</h4>
                <p class="text-gray-600">Unique cross-continental expertise. We understand the market dynamics and consumer behavior in both regions.</p>
            </div>

            <!-- Point 3 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-accent">
                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-bolt text-accent text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Fast Delivery</h4>
                <p class="text-gray-600">In the digital world, speed is key. We launch your campaigns and websites quickly without compromising on quality.</p>
            </div>

            <!-- Point 4 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-primary">
                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-laptop-code text-primary text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Modern Web Design</h4>
                <p class="text-gray-600">Mobile-first, lightning-fast, and conversion-optimized websites that turn visitors into loyal customers.</p>
            </div>

            <!-- Point 5 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-secondary">
                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-chart-pie text-secondary text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Digital Marketing Expertise</h4>
                <p class="text-gray-600">From SEO to Social Media Ads, we use the latest tools and trends to keep you ahead of the competition.</p>
            </div>

            <!-- Point 6 -->
            <div class="bg-white p-8 rounded-lg transition-all duration-200 hover:shadow-lg border-b-4 border-accent">
                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-headset text-accent text-xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Long-term Support</h4>
                <p class="text-gray-600">We aren't just a service provider; we are your partner. We provide ongoing support to ensure your long-term success.</p>
            </div>
        </div>
    </div>
</section>

<!-- FOUNDER SECTION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1">
                <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">Meet The Founder</span>
                </div>
                <h2 class="text-4xl font-bold text-dark mb-2 tracking-tighter">Abdulrahman Jalloh</h2>
                <p class="text-primary font-bold text-lg mb-6 uppercase tracking-widest">Web Developer • Marketer • Strategist</p>
                
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    "My mission is simple: to help small businesses in the USA and Africa compete and grow through modern digital solutions. I believe that every business owner, regardless of their location, deserves access to high-quality digital marketing that works."
                </p>
                
                <div class="space-y-4 mb-8">
                    <div class="flex items-center p-4 bg-muted rounded-md">
                        <i class="fas fa-code w-10 text-primary"></i>
                        <span class="text-dark font-semibold text-sm uppercase">Full-Stack Development</span>
                    </div>
                    <div class="flex items-center p-4 bg-muted rounded-md">
                        <i class="fas fa-bullhorn w-10 text-secondary"></i>
                        <span class="text-dark font-semibold text-sm uppercase">Social Media Marketing</span>
                    </div>
                    <div class="flex items-center p-4 bg-muted rounded-md">
                        <i class="fas fa-lightbulb w-10 text-accent"></i>
                        <span class="text-dark font-semibold text-sm uppercase">Digital Growth Strategy</span>
                    </div>
                    <div class="flex items-center p-4 bg-muted rounded-md">
                        <i class="fas fa-robot w-10 text-secondary"></i>
                        <span class="text-dark font-semibold text-sm uppercase">AI Generalist</span>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}?" class="h-14 px-8 bg-green-500 text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        <i class="fab fa-whatsapp mr-2 text-xl"></i>
                        Message on WhatsApp
                    </a>
                </div>
            </div>
            
            <div class="order-1 lg:order-2 relative">
                <div class="aspect-square rounded-2xl overflow-hidden shadow-2xl border-8 border-muted">
                    <!-- Replace with actual founder image -->
                    <img src="{{ asset('public/assets/images/founder.png') }}" alt="Abdulrahman Jalloh" class="w-full h-full object-cover">
                </div>
                <div class="absolute -top-6 -right-6 w-32 h-32 bg-accent rounded-full -z-10 animate-pulse"></div>
                <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-primary rounded-full -z-10"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-accent relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready to Take the Next Step?
        </h2>
        <p class="text-xl text-white/90 mb-10 leading-relaxed">
            Stop waiting for growth. Let's create it. Book your consultation today or send us a message to discuss your project.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-white text-accent rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Book a Consultation
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}?" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-accent">
                WhatsApp Message
            </a>
        </div>
    </div>
</section>
<!-- FREE CONSULTATION SECTION -->
<section id="consultation-form" class="py-20 lg:py-32 bg-primary relative overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <!-- Info Side -->
                <div class="md:col-span-2 bg-accent p-8 text-white">
                    <h3 class="text-3xl font-bold mb-6">Book a Free Session</h3>
                    <p class="mb-8 text-white/80">Select a date and tell us about your goals. Our experts will guide you through a custom strategy.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Strategy Call</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Market Analysis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> No Obligation</li>
                    </ul>
                </div>

                <!-- Form Side -->
                <div class="md:col-span-3 p-8 lg:p-12">
                    @if(session('consultation_success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                            {{ session('consultation_success') }}
                        </div>
                    @endif

                    <form action="{{ route('consultation.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Full Name</label>
                            <input type="text" name="name" required class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="Enter your name">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Email Address</label>
                            <input type="email" name="email" required class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors" placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Preferred Meeting Date</label>
                            <input type="date" name="meeting_date" required min="{{ date('Y-m-d') }}" class="w-full h-12 border-b-2 border-gray-200 focus:border-primary outline-none transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Subject / Discussion Topic</label>
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-primary outline-none transition-colors resize-none" placeholder="What would you like to discuss?"></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02]">
                            Confirm Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection