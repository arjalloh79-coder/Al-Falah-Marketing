@extends('User.main')

@section('title', 'Content Creation Services - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .content-card {
        transition: all 0.3s ease;
    }
    .content-card:hover {
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
        background: #3b82f6;
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
        background: linear-gradient(transparent, rgba(59, 130, 246, 0.9));
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
    .stat-item {
        transition: all 0.3s ease;
    }
    .stat-item:hover {
        transform: scale(1.05);
    }
    .benefit-item {
        transition: all 0.3s ease;
    }
    .benefit-item:hover {
        transform: scale(1.02);
        background: #eff6ff;
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
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">Content Creation</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Create Content That <span class="text-accent">Converts</span> and <span class="text-accent">Engages</span>
                </h1>
                <p class="text-lg text-white/90 mb-8 leading-relaxed">
                    From blogs and videos to social media content and graphics — we produce high-quality content 
                    that positions your brand as a leader in your industry.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#consultation-form" class="h-14 px-8 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Start Creating Content
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
                                <i class="fas fa-video text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Video Marketing</p>
                                <p class="text-white/70 text-sm">Engaging video content</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-pen-fancy text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Blog & Copywriting</p>
                                <p class="text-white/70 text-sm">SEO-optimized articles</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Graphic Design</p>
                                <p class="text-white/70 text-sm">Professional visuals</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                                <i class="fas fa-share-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Content Strategy</p>
                                <p class="text-white/70 text-sm">Data-driven planning</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STATS SECTION -->
<section class="py-16 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-primary">10M+</div>
                <p class="text-gray-600 text-sm mt-1">Content Views</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-primary">500+</div>
                <p class="text-gray-600 text-sm mt-1">Blog Posts Written</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-primary">200+</div>
                <p class="text-gray-600 text-sm mt-1">Videos Produced</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-primary">1000+</div>
                <p class="text-gray-600 text-sm mt-1">Graphics Created</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY CONTENT MARKETING -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Why Content Matters</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Content is the Heart of <span class="text-primary">Digital Marketing</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Great content builds trust, drives engagement, and converts visitors into loyal customers.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-search text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Boost SEO Rankings</h4>
                <p class="text-gray-600">Quality content helps you rank higher on Google and drives organic traffic to your website.</p>
            </div>
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-handshake text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Build Trust & Authority</h4>
                <p class="text-gray-600">Valuable content positions you as an expert in your industry and builds trust with your audience.</p>
            </div>
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Increase Engagement</h4>
                <p class="text-gray-600">Engaging content keeps your audience interested, shares your message, and drives conversions.</p>
            </div>
        </div>
    </div>
</section>

<!-- CONTENT SERVICES -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Content Services</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Comprehensive <span class="text-primary">Content Solutions</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We create all types of content to help you connect with your audience and grow your business.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Video Marketing -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-video text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Video Marketing</h3>
                <p class="text-gray-600 mb-4">Professional video content that tells your story, showcases your products, and engages your audience.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Brand Videos</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Product Demos</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Tutorials & How-To's</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Social Media Videos</li>
                </ul>
            </div>

            <!-- Blog & Copywriting -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-pen-nib text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Blog & Copywriting</h3>
                <p class="text-gray-600 mb-4">SEO-optimized blog posts and compelling copy that drives traffic and converts readers into customers.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> SEO Blog Posts</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Website Copy</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Email Newsletters</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Case Studies</li>
                </ul>
            </div>

            <!-- Graphics Production -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-paint-brush text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Graphics Production</h3>
                <p class="text-gray-600 mb-4">Eye-catching graphics and visuals that enhance your brand and make your content stand out.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Social Media Graphics</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Infographics</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Brand Assets</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Presentation Design</li>
                </ul>
            </div>

            <!-- Social Media Content -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-share-alt text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Social Media Content</h3>
                <p class="text-gray-600 mb-4">Engaging content tailored for each social media platform to maximize reach and engagement.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Post Creation</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Stories & Reels</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Carousel Posts</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Content Calendar</li>
                </ul>
            </div>

            <!-- Content Strategy -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Content Strategy</h3>
                <p class="text-gray-600 mb-4">Data-driven content strategies that align with your business goals and audience needs.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Content Audit</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Audience Research</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Content Planning</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Performance Tracking</li>
                </ul>
            </div>

            <!-- Podcast Production -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-primary">
                <div class="w-16 h-16 bg-primary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-microphone text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Podcast Production</h3>
                <p class="text-gray-600 mb-4">End-to-end podcast production services from recording to distribution.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Audio Editing</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Show Notes</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Distribution</li>
                    <li><i class="fas fa-check-circle text-primary mr-2"></i> Cover Art Design</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- PROCESS SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Our Process</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">How We Create <span class="text-primary">Amazing Content</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A proven process that delivers high-quality content consistently.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                <h4 class="text-xl font-bold text-dark mb-2">Strategy</h4>
                <p class="text-gray-600 text-sm">We develop a content strategy aligned with your goals, audience, and brand voice.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                <h4 class="text-xl font-bold text-dark mb-2">Creation</h4>
                <p class="text-gray-600 text-sm">Our expert team produces high-quality content in various formats and styles.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                <h4 class="text-xl font-bold text-dark mb-2">Review & Refine</h4>
                <p class="text-gray-600 text-sm">We review, edit, and refine content to ensure it meets the highest quality standards.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                <h4 class="text-xl font-bold text-dark mb-2">Distribute & Optimize</h4>
                <p class="text-gray-600 text-sm">We distribute content across channels and continuously optimize based on performance.</p>
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
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Frequently Asked <span class="text-primary">Questions</span></h2>
        </div>

        <div class="space-y-2">
            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How quickly can you start creating content?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We can start creating content within 1-2 weeks of onboarding. The initial phase includes strategy development and content planning to ensure alignment with your goals.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you specialize in any particular industry?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We work with clients across various industries including technology, healthcare, finance, real estate, e-commerce, and more. We adapt our content to your specific industry needs.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can you create content in different languages?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we can create content in multiple languages including English, French, Spanish, and more. We work with native speakers to ensure quality and cultural relevance.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How do you ensure content quality?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We have a rigorous quality control process that includes research, drafting, editing, and proofreading. All content is reviewed by senior editors before delivery.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can I see samples before committing?</h4>
                    <i class="fas fa-chevron-down text-primary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Absolutely! We'll share portfolio samples and can even create a test piece to ensure our style matches your expectations before you commit to a package.</p>
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
            Ready to Create Amazing Content?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Let's create content that engages your audience, builds your brand, and drives real results.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Start Creating
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
                    <h3 class="text-3xl font-bold mb-6">Book a Free Content Strategy Call</h3>
                    <p class="mb-8 text-white/80">Let's discuss your content needs and create a strategy that drives engagement and growth.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Strategy Session</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Content Audit</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Custom Content Plan</li>
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
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-primary outline-none transition-colors resize-none" placeholder="Tell us about your content needs..."></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-primary text-white rounded-md font-bold uppercase tracking-widest hover:bg-blue-700 transition-all transform hover:scale-[1.02]">
                            Book Free Content Strategy Call
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