@extends('User.main')

@section('title', 'Our Services - Al-Falah Digital Marketing Agency')

<!-- Include Swiper.js for the Slider -->
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .swiper-pagination-bullet-active {
        background: #3b82f6 !important; /* Matches your primary color */
    }
</style>
@endsection

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-primary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
            <span class="text-white font-semibold text-sm uppercase tracking-wider">What We Offer</span>
        </div>
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
            Helping Small Businesses Get <span class="text-accent">More Customers</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            We build professional websites and digital marketing systems that help businesses in the USA and Africa attract, convert, and retain customers using Websites, SEO & AI-Powered Marketing.
        </p>
    </div>
</section>

<!-- FULL-STACK PARTNER INTRO -->
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-dark mb-6 tracking-tighter">A full-stack marketing partner</h2>
        <p class="text-xl text-gray-600 leading-relaxed">
            Six core services — one unified team. From strategy through execution and measurement, we handle every touchpoint of your digital ecosystem.
        </p>
    </div>
</section>

<!-- CORE SERVICES GRID (6 SERVICES) -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Service 1: Web Development -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-primary transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-code text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Web Development</h3>
                <p class="text-gray-600 leading-relaxed">
                    Custom-coded, high-performance websites. We build lightning-fast, mobile-friendly sites designed to convert visitors into customers 24/7.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-primary mr-2"></i> Custom Web Apps</li>
                    <li><i class="fas fa-check text-primary mr-2"></i> E-commerce Solutions</li>
                    <li><i class="fas fa-check text-primary mr-2"></i> CMS Integration</li>
                </ul>
                 <!-- Know More Button -->
                <a href="{{ route('services.web-development') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Service 2: Digital Marketing -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-secondary transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-secondary rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-bullhorn text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Digital Marketing</h3>
                <p class="text-gray-600 leading-relaxed">
                    Data-driven growth strategies. From Local SEO to Google Ads, we ensure your business ranks high and gets found by the right audience.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-secondary mr-2"></i> SEO & SEM</li>
                    <li><i class="fas fa-check text-secondary mr-2"></i> Social Media Ads</li>
                    <li><i class="fas fa-check text-secondary mr-2"></i> Email Marketing</li>
                </ul>

                 <!-- Know More Button -->
                <a href="{{ route('services.digital-marketing') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>


            </div>

            <!-- Service 3: Branding & Design -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-accent transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-palette text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Branding & Design</h3>
                <p class="text-gray-600 leading-relaxed">
                    We create visual identities that tell your story. Professional logos, UI/UX design, and brand guidelines that build trust and authority.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-accent mr-2"></i> Logo & Visual Identity</li>
                    <li><i class="fas fa-check text-accent mr-2"></i> UI/UX Design</li>
                    <li><i class="fas fa-check text-accent mr-2"></i> Marketing Collateral</li>
                </ul>
                
                 <a href="{{ route('services.branding') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
                
            </div>

            <!-- Service 4: AI & Automation -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-primary transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-microchip text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">AI & Automation</h3>
                <p class="text-gray-600 leading-relaxed">
                    Work smarter, not harder. We implement AI chatbots and automated lead nurture workflows to save you hours of manual work every day.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-primary mr-2"></i> AI Chatbots</li>
                    <li><i class="fas fa-check text-primary mr-2"></i> CRM Automation</li>
                    <li><i class="fas fa-check text-primary mr-2"></i> Workflow Optimization</li>
                </ul>

                  <a href="{{ route('services.automation') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
                

            </div>

            <!-- Service 5: Content Creation -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-secondary transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-secondary rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-pen-nib text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">Content Creation</h3>
                <p class="text-gray-600 leading-relaxed">
                    Content that converts. Our team produces high-quality blogs, videos, and social media content that positions you as a leader in your industry.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-secondary mr-2"></i> Video Marketing</li>
                    <li><i class="fas fa-check text-secondary mr-2"></i> Blog & Copywriting</li>
                    <li><i class="fas fa-check text-secondary mr-2"></i> Graphics Production</li>
                </ul>

                <a href="{{ route('services.content') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>

            <!-- Service 6: IT Solutions -->
            <div class="p-10 bg-muted rounded-2xl border-b-8 border-accent transition-all hover:-translate-y-2">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-8">
                    <i class="fas fa-server text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-4">IT Solutions</h3>
                <p class="text-gray-600 leading-relaxed">
                    Reliable tech support for your growth. From secure cloud hosting to enterprise IT management, we keep your digital operations running smooth.
                </p>
                <ul class="mt-6 space-y-2 text-sm text-gray-700 font-semibold">
                    <li><i class="fas fa-check text-accent mr-2"></i> Cloud Hosting</li>
                    <li><i class="fas fa-check text-accent mr-2"></i> Cyber Security</li>
                    <li><i class="fas fa-check text-accent mr-2"></i> Tech Support</li>
                </ul>

                 <a href="{{ route('services.solution') }}" class="mt-6 inline-flex items-center text-primary font-bold hover:text-blue-700 transition group">
                    <span>Know More</span>
                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
            
            

        </div>
    </div>
</section>

<!-- AUTOMATIC CARD SLIDER SECTION -->
<section class="py-20 lg:py-32 bg-muted overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Specialized Solutions</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Marketing Systems Built for You</h2>
            <p class="text-gray-600">Tailored strategies that fit your specific business needs.</p>
        </div>

        <!-- Swiper Slider Container -->
        <div class="swiper mySwiper pb-12">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide h-auto">
                    <div class="bg-white p-8 rounded-xl shadow-sm h-full flex flex-col border border-gray-100">
                        <h4 class="text-xl font-bold text-primary mb-4">For USA Service Biz</h4>
                        <p class="text-gray-600 text-sm mb-6">Attract local clients for HVAC, Plumbing, or Legal services with high-intent Google Ads and Local SEO.</p>
                        <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="mt-auto text-dark font-bold hover:text-primary inline-flex items-center">Get Started <i class="fas fa-chevron-right ml-2 text-xs"></i></a>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide h-auto">
                    <div class="bg-white p-8 rounded-xl shadow-sm h-full flex flex-col border border-gray-100">
                        <h4 class="text-xl font-bold text-secondary mb-4">For African Startups</h4>
                        <p class="text-gray-600 text-sm mb-6">Scale your fintech or e-commerce brand across the continent with aggressive social media growth and viral content.</p>
                        <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}?" class="mt-auto text-dark font-bold hover:text-secondary inline-flex items-center">Get Started <i class="fas fa-chevron-right ml-2 text-xs"></i></a>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide h-auto">
                    <div class="bg-white p-8 rounded-xl shadow-sm h-full flex flex-col border border-gray-100">
                        <h4 class="text-xl font-bold text-accent mb-4">AI Integration</h4>
                        <p class="text-gray-600 text-sm mb-6">Reduce manual work by 40% with automated email responders and AI-driven CRM management systems.</p>
                        <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="mt-auto text-dark font-bold hover:text-accent inline-flex items-center">Get Started <i class="fas fa-chevron-right ml-2 text-xs"></i></a>
                    </div>
                </div>
                <!-- Slide 4 -->
                <div class="swiper-slide h-auto">
                    <div class="bg-white p-8 rounded-xl shadow-sm h-full flex flex-col border border-gray-100">
                        <h4 class="text-xl font-bold text-primary mb-4">E-commerce Growth</h4>
                        <p class="text-gray-600 text-sm mb-6">Global shipping brands: get more sales with professional Shopify setups and Retargeting Ads.</p>
                        <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="mt-auto text-dark font-bold hover:text-primary inline-flex items-center">Get Started <i class="fas fa-chevron-right ml-2 text-xs"></i></a>
                    </div>
                </div>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- THE PROCESS SECTION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <img src="{{ asset('public/assets/images/video.jpg') }}" alt="Marketing Strategy" class="rounded-2xl shadow-xl">
            </div>
            <div>
                <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">How We Work</span>
                </div>
                <h2 class="text-4xl font-bold text-dark mb-6 tracking-tighter">Your Path to More Customers</h2>
                <div class="space-y-8">
                    <div class="flex">
                        <div class="w-12 h-12 bg-primary/10 text-primary flex-shrink-0 flex items-center justify-center rounded-full font-bold">1</div>
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-dark">Discovery & Strategy</h4>
                            <p class="text-gray-600">We analyze your market in the USA or Africa to find the gaps where your competitors are weak.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-12 h-12 bg-secondary/10 text-secondary flex-shrink-0 flex items-center justify-center rounded-full font-bold">2</div>
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-dark">Build & Launch</h4>
                            <p class="text-gray-600">We deploy your website and AI systems, ensuring everything is tracked for performance.</p>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="w-12 h-12 bg-accent/10 text-accent flex-shrink-0 flex items-center justify-center rounded-full font-bold">3</div>
                        <div class="ml-4">
                            <h4 class="text-xl font-bold text-dark">Scale & Automate</h4>
                            <p class="text-gray-600">Once we see what works, we scale the budget and automate the leads so you can focus on running your business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-primary relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready to Build Your Digital Sales System?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Don't let your competitors take your customers. Start your transformation today.
        </p>
        <div class="flex flex-col sm:row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Book a Consultation
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-primary">
                Message on WhatsApp
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
</script>
@endsection