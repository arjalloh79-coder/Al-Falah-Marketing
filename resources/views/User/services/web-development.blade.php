@extends('User.main')

@section('title', 'Web Development Services - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .tech-badge {
        transition: all 0.3s ease;
    }
    .tech-badge:hover {
        transform: scale(1.05);
        background: #3b82f6 !important;
        color: white !important;
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
        background: #e5e7eb;
    }
    .pricing-card {
        transition: all 0.3s ease;
    }
    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    .pricing-card.featured {
        border: 2px solid #3b82f6;
        position: relative;
    }
    .pricing-card.featured::before {
        content: 'Most Popular';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #3b82f6;
        color: white;
        padding: 4px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
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
        background: linear-gradient(transparent, rgba(59, 130, 246, 0.9));
        padding: 30px 20px 20px;
        transition: all 0.4s ease;
    }
    .portfolio-item:hover .portfolio-overlay {
        bottom: 0;
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
        color: #3b82f6;
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .faq-answer.open {
        max-height: 200px;
    }
</style>
@endsection

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-primary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">Web Development</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Build a Website That <span class="text-accent">Converts Visitors</span> Into Customers
                </h1>
                <p class="text-lg text-white/90 mb-8 leading-relaxed">
                    Custom-coded, high-performance websites designed for speed, SEO, and maximum conversions. 
                    From small business sites to complex e-commerce platforms.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#consultation-form" class="h-14 px-8 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Start Your Project
                    </a>
                    <a href="{{ route('portfolio') }}" class="h-14 px-8 border-2 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-primary">
                        View Our Work
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-rocket text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Lightning Fast</p>
                                <p class="text-white/70 text-sm">99% Page Speed Score</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Secure & Reliable</p>
                                <p class="text-white/70 text-sm">SSL & Cloud Hosting</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Mobile Optimized</p>
                                <p class="text-white/70 text-sm">Responsive Design</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-search text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">SEO Ready</p>
                                <p class="text-white/70 text-sm">Built for Google Rankings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Why Choose Us</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Websites That <span class="text-primary">Drive Results</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We don't just build websites — we build digital sales systems that grow your business.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-code text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Custom Development</h4>
                <p class="text-gray-600 text-sm">No templates. Every line of code is written specifically for your business needs.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tachometer-alt text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Optimized Performance</h4>
                <p class="text-gray-600 text-sm">Lightning-fast loading times that reduce bounce rates and improve conversions.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-accent/10 text-accent rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Responsive Design</h4>
                <p class="text-gray-600 text-sm">Perfect experience on desktop, tablet, and mobile devices.</p>
            </div>
            <div class="text-center">
                <div class="w-20 h-20 bg-primary/10 text-primary rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-headset text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-2">Ongoing Support</h4>
                <p class="text-gray-600 text-sm">24/7 maintenance and support to keep your site running smoothly.</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES WE OFFER -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">What We Build</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Comprehensive Web Solutions</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                From simple landing pages to complex web applications — we've got you covered.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-laptop-code text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Business Websites</h3>
                <p class="text-gray-600 mb-4">Professional websites that establish credibility and convert visitors into customers.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Custom Design & Development</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Content Management System</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> SEO Optimization</li>
                </ul>
            </div>

            <!-- Service 2 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-secondary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-shopping-cart text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">E-Commerce Stores</h3>
                <p class="text-gray-600 mb-4">Full-featured online stores with secure payment processing and inventory management.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> Shopify / WooCommerce</li>
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> Payment Gateway Integration</li>
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> Product Management System</li>
                </ul>
            </div>

            <!-- Service 3 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-cogs text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Web Applications</h3>
                <p class="text-gray-600 mb-4">Custom web applications built to solve specific business problems and streamline operations.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Custom Dashboards</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> API Integration</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Data Management Systems</li>
                </ul>
            </div>

            <!-- Service 4 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Landing Pages</h3>
                <p class="text-gray-600 mb-4">High-converting landing pages designed for specific marketing campaigns and lead generation.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> A/B Testing Ready</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Lead Capture Forms</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Analytics Integration</li>
                </ul>
            </div>

            <!-- Service 5 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-secondary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-paint-brush text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">UI/UX Design</h3>
                <p class="text-gray-600 mb-4">User-centered design that creates intuitive, engaging experiences for your visitors.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> Wireframing & Prototyping</li>
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> User Testing</li>
                    <li><i class="fas fa-check-circle text-secondary mr-2"></i> Design Systems</li>
                </ul>
            </div>

            <!-- Service 6 -->
            <div class="service-card bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-cloud-upload-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Maintenance & Support</h3>
                <p class="text-gray-600 mb-4">Ongoing maintenance, updates, and security monitoring to keep your website safe and fast.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Security Updates</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Performance Optimization</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> 24/7 Monitoring</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- TECH STACK -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Technology Stack</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Modern Technologies We Use</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We use the latest tools and frameworks to build fast, secure, and scalable websites.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">HTML5</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">CSS3</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">JavaScript</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">React</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Vue.js</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Laravel</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">PHP</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Node.js</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Python</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">MySQL</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">MongoDB</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">AWS</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Docker</span>
            <span class="tech-badge px-6 py-3 bg-muted rounded-full text-dark font-semibold">Git</span>
        </div>
    </div>
</section>

<!-- PROCESS SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">How We Work</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Our Development Process</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A transparent, collaborative approach to building your website.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="process-step text-center">
                <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                <h4 class="text-xl font-bold text-dark mb-2">Discovery</h4>
                <p class="text-gray-600 text-sm">We learn about your business, goals, and target audience to create a tailored strategy.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-12 h-12 bg-secondary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                <h4 class="text-xl font-bold text-dark mb-2">Design</h4>
                <p class="text-gray-600 text-sm">We create wireframes and visual designs that align with your brand and user needs.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-12 h-12 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                <h4 class="text-xl font-bold text-dark mb-2">Development</h4>
                <p class="text-gray-600 text-sm">We write clean, efficient code and build your website with modern technologies.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-12 h-12 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                <h4 class="text-xl font-bold text-dark mb-2">Launch & Support</h4>
                <p class="text-gray-600 text-sm">We deploy your site, test thoroughly, and provide ongoing maintenance and support.</p>
            </div>
        </div>
    </div>
</section>



<!-- FAQ SECTION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">FAQ</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Frequently Asked Questions</h2>
        </div>

        <div class="space-y-2">
            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How long does it take to build a website?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Typically, a business website takes 2-4 weeks, while e-commerce or custom web applications may take 6-8 weeks. We'll provide a clear timeline during the discovery phase.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you provide hosting and domain services?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we offer reliable hosting solutions and can help you register your domain. We recommend our premium hosting plans for optimal performance and security.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can you redesign my existing website?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Absolutely! We specialize in redesigning outdated websites to improve performance, user experience, and conversion rates while maintaining your brand identity.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you offer maintenance packages?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we offer ongoing maintenance and support packages to keep your website secure, updated, and performing at its best. Contact us for custom packages.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Will my website be mobile-friendly?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, all websites we build are fully responsive and optimized for all devices including smartphones, tablets, and desktops.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-primary relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready to Build Your Website?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Let's create a website that drives real results for your business.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Start Your Project
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-primary">
                Message on WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- FREE CONSULTATION SECTION -->
<section id="consultation-form" class="py-20 lg:py-32 bg-primary relative overflow-hidden">
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-2 bg-accent p-8 text-white">
                    <h3 class="text-3xl font-bold mb-6">Book a Free Consultation</h3>
                    <p class="mb-8 text-white/80">Let's discuss your project goals. Our experts will guide you through a custom web development strategy.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Strategy Call</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Project Scope Analysis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Custom Quote & Timeline</li>
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
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-primary outline-none transition-colors resize-none" placeholder="Tell us about your project..."></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02]">
                            Book Consultation
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