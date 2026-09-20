@extends('User.main')

@section('title', 'Branding & Design Services - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .design-card {
        transition: all 0.3s ease;
    }
    .design-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .process-step {
        position: relative;
    }
    .process-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 24px;
        top: 60px;
        bottom: 0;
        width: 2px;
        background: #f59e0b;
        opacity: 0.3;
    }
    .portfolio-item {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
    }
    .portfolio-item img {
        transition: all 0.5s ease;
    }
    .portfolio-item:hover img {
        transform: scale(1.05);
    }
    .portfolio-overlay {
        position: absolute;
        bottom: -100%;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(245, 158, 11, 0.9));
        padding: 30px 20px 20px;
        transition: all 0.4s ease;
    }
    .portfolio-item:hover .portfolio-overlay {
        bottom: 0;
    }
    .pricing-card {
        transition: all 0.3s ease;
    }
    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    .pricing-card.featured {
        border: 2px solid #f59e0b;
        position: relative;
    }
    .pricing-card.featured::before {
        content: 'Most Popular';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #f59e0b;
        color: white;
        padding: 4px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }
    .faq-item {
        border-bottom: 1px solid #e5e7eb;
        padding: 20px 0;
    }
    .faq-item:last-child {
        border-bottom: none;
    }
    .faq-question {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .faq-question:hover {
        color: #f59e0b;
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .faq-answer.open {
        max-height: 200px;
    }
    .testimonial-card {
        transition: all 0.3s ease;
    }
    .testimonial-card:hover {
        transform: scale(1.02);
    }
    .brand-element {
        border: 2px dashed #e5e7eb;
        transition: all 0.3s ease;
    }
    .brand-element:hover {
        border-color: #f59e0b;
        background: #fffbeb;
    }
</style>
@endsection

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-accent overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">Branding & Design</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Build a Brand That <span class="text-primary">Stands Out</span> and <span class="text-primary">Connects</span>
                </h1>
                <p class="text-lg text-white/90 mb-8 leading-relaxed">
                    From logos and visual identities to complete brand guidelines and UI/UX design — 
                    we create cohesive brand experiences that build trust and drive recognition.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#consultation-form" class="h-14 px-8 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Start Your Brand Journey
                    </a>
                    <a href="{{ route('portfolio') }}" class="h-14 px-8 border-2 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-accent">
                        View Our Work
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-paint-brush text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Creative Excellence</p>
                                <p class="text-white/70 text-sm">Award-winning designs</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">User-Centered</p>
                                <p class="text-white/70 text-sm">Designs that convert</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-rocket text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Fast Turnaround</p>
                                <p class="text-white/70 text-sm">Delivery in 2-4 weeks</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-check-circle text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Satisfaction Guaranteed</p>
                                <p class="text-white/70 text-sm">Unlimited revisions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY BRANDING MATTERS -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Why Branding Matters</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Your Brand Is Your <span class="text-accent">Greatest Asset</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A strong brand creates emotional connections, builds trust, and sets you apart from competitors.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Emotional Connection</h4>
                <p class="text-gray-600 text-sm">Brands that evoke emotion have 3x higher customer loyalty and retention rates.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Trust & Credibility</h4>
                <p class="text-gray-600 text-sm">Professional branding builds instant trust and positions you as an industry leader.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-dollar-sign text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Premium Pricing</h4>
                <p class="text-gray-600 text-sm">Strong brands can charge 20-50% more for their products and services.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Brand Recognition</h4>
                <p class="text-gray-600 text-sm">Consistent branding makes your business instantly recognizable across all channels.</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES WE OFFER -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Our Services</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Comprehensive Branding <span class="text-accent">& Design Solutions</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We offer end-to-end branding services to help you create a powerful and memorable brand identity.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1: Logo Design -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-pencil-ruler text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Logo Design</h3>
                <p class="text-gray-600 mb-4">Professional logo design that captures your brand essence and makes a lasting impression.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Multiple Concepts</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Full Vector Files</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Brand Color Palette</li>
                </ul>
            </div>

            <!-- Service 2: Visual Identity -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-palette text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Visual Identity</h3>
                <p class="text-gray-600 mb-4">Complete visual identity system including color schemes, typography, and design elements.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Color Psychology</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Typography Guidelines</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Design Assets</li>
                </ul>
            </div>

            <!-- Service 3: UI/UX Design -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-laptop text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">UI/UX Design</h3>
                <p class="text-gray-600 mb-4">User-centered interface design that creates intuitive and engaging digital experiences.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Wireframing</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Interactive Prototypes</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> User Testing</li>
                </ul>
            </div>

            <!-- Service 4: Brand Guidelines -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-book text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Brand Guidelines</h3>
                <p class="text-gray-600 mb-4">Comprehensive brand style guide to ensure consistent brand application across all channels.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Brand Story & Values</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Visual & Tone Guidelines</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Implementation Manual</li>
                </ul>
            </div>

            <!-- Service 5: Marketing Collateral -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-file-alt text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Marketing Collateral</h3>
                <p class="text-gray-600 mb-4">Designs for all your marketing materials including business cards, brochures, and social media assets.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Business Cards</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Brochures & Flyers</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Social Media Templates</li>
                </ul>
            </div>

            <!-- Service 6: Packaging Design -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-box text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Packaging Design</h3>
                <p class="text-gray-600 mb-4">Creative packaging solutions that make your products stand out on the shelf and tell your brand story.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Product Packaging</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Label Design</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Unboxing Experience</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- BRAND ELEMENTS SHOWCASE -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">What We Create</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Every Brand Element <span class="text-accent">Tells Your Story</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From visual identity to brand guidelines — we create cohesive brand experiences.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-paint-brush text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Logo Design</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-palette text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Color Palette</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-font text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Typography</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Visual Assets</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-file-pdf text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Brand Guidelines</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-mobile-alt text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">UI/UX Design</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-images text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Collateral</p>
            </div>
            <div class="brand-element p-6 text-center rounded-lg">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-box-open text-2xl"></i>
                </div>
                <p class="font-bold text-dark text-sm">Packaging</p>
            </div>
        </div>
    </div>
</section>

<!-- PROCESS SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Our Process</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">How We Build Your <span class="text-accent">Brand Identity</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A collaborative process that ensures your brand perfectly represents your vision and values.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                <h4 class="text-xl font-bold text-dark mb-2">Discovery</h4>
                <p class="text-gray-600 text-sm">We learn about your business, values, target audience, and brand vision through in-depth consultation.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                <h4 class="text-xl font-bold text-dark mb-2">Research & Strategy</h4>
                <p class="text-gray-600 text-sm">We analyze your market, competitors, and audience to develop a strategic brand positioning.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                <h4 class="text-xl font-bold text-dark mb-2">Design & Development</h4>
                <p class="text-gray-600 text-sm">We create visual concepts, refine based on feedback, and develop the complete brand identity system.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                <h4 class="text-xl font-bold text-dark mb-2">Launch & Guidelines</h4>
                <p class="text-gray-600 text-sm">We deliver final assets and comprehensive brand guidelines to ensure consistent application.</p>
            </div>
        </div>
    </div>
</section>


<!-- TESTIMONIALS -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Testimonials</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">What Our Clients <span class="text-accent">Say</span></h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-sm">
                <div class="flex text-accent mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 mb-4">"The branding package transformed our business. Our new identity perfectly captures who we are and has helped us attract premium clients."</p>
                <div>
                    <p class="font-bold text-dark">Sarah Johnson</p>
                    <p class="text-sm text-gray-500">CEO, TechStart Solutions</p>
                </div>
            </div>
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-sm">
                <div class="flex text-accent mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 mb-4">"The UI/UX design for our app was exceptional. Our users love the intuitive interface and we've seen a 40% increase in engagement."</p>
                <div>
                    <p class="font-bold text-dark">Michael Chen</p>
                    <p class="text-sm text-gray-500">Founder, HealthTrack App</p>
                </div>
            </div>
            <div class="testimonial-card bg-white p-8 rounded-2xl shadow-sm">
                <div class="flex text-accent mb-4">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="text-gray-600 mb-4">"From logo to brand guidelines, everything was delivered with exceptional quality and attention to detail. Highly recommended!"</p>
                <div>
                    <p class="font-bold text-dark">Emily Rodriguez</p>
                    <p class="text-sm text-gray-500">Marketing Director, GreenLife Co.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">FAQ</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Frequently Asked <span class="text-accent">Questions</span></h2>
        </div>

        <div class="space-y-2">
            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How long does the branding process take?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Typically, complete branding projects take 3-6 weeks depending on the scope. Logo design usually takes 2-3 weeks, while full brand identity systems may take 4-6 weeks.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you offer revisions?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we offer unlimited revisions during the design phase. We work closely with you until you're 100% satisfied with your brand identity.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">What file formats will I receive?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>You'll receive all files in multiple formats including AI, EPS, PNG, JPG, and SVG. We ensure you have everything needed for both print and digital use.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can you redesign my existing brand?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Absolutely! We specialize in brand refresh and redesign. We'll preserve your brand equity while modernizing and improving your visual identity.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you provide brand strategy as well?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, our branding services include strategic brand positioning, messaging development, and target audience analysis to ensure your brand connects with the right people.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-accent relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready to Build a Brand That Stands Out?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Let's create a powerful brand identity that tells your story and connects with your audience.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Start Your Brand Journey
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-accent">
                Message on WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- FREE CONSULTATION SECTION -->
<section id="consultation-form" class="py-20 lg:py-32 bg-accent relative overflow-hidden">
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-2 bg-primary p-8 text-white">
                    <h3 class="text-3xl font-bold mb-6">Book a Free Brand Consultation</h3>
                    <p class="mb-8 text-white/80">Let's discuss your brand vision and create a strategy that makes your business unforgettable.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Brand Strategy Session</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Competitor Brand Analysis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Custom Brand Roadmap</li>
                    </ul>
                </div>

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
                            <input type="text" name="name" required class="w-full h-12 border-b-2 border-gray-200 focus:border-accent outline-none transition-colors" placeholder="Enter your name">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Email Address</label>
                            <input type="email" name="email" required class="w-full h-12 border-b-2 border-gray-200 focus:border-accent outline-none transition-colors" placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Preferred Meeting Date</label>
                            <input type="date" name="meeting_date" required min="{{ date('Y-m-d') }}" class="w-full h-12 border-b-2 border-gray-200 focus:border-accent outline-none transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Subject / Discussion Topic</label>
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-accent outline-none transition-colors resize-none" placeholder="Tell us about your brand vision..."></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-accent text-white rounded-md font-bold uppercase tracking-widest hover:bg-orange-600 transition-all transform hover:scale-[1.02]">
                            Book Free Brand Consultation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;
        const icon = element.querySelector('i');
        
        answer.classList.toggle('open');
        icon.style.transform = answer.classList.contains('open') ? 'rotate(180deg)' : 'rotate(0)';
        
        // Close other FAQs
        const allFAQs = document.querySelectorAll('.faq-answer');
        allFAQs.forEach(faq => {
            if (faq !== answer && faq.classList.contains('open')) {
                faq.classList.remove('open');
                const otherIcon = faq.previousElementSibling.querySelector('i');
                if (otherIcon) {
                    otherIcon.style.transform = 'rotate(0)';
                }
            }
        });
    }
</script>
@endsection