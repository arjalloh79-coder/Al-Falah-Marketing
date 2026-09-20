@extends('User.main')

@section('title', 'Al-Falah - Digital Marketing Agency')

@section('main-section')

<!-- HERO SECTION -->
<section id="home" class="relative bg-primary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <!-- Decorative Background Shapes -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    <div class="absolute top-1/2 left-1/4 w-64 h-64 bg-white/5 rotate-45"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">Digital Marketing Excellence</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Transform Your Brand Into A
                    <span class="text-accent"> Market Leader</span>
                </h1>
                
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    We deliver data-driven marketing strategies that amplify your reach, engage your audience, and drive measurable growth.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#contact" class="h-16 px-8 bg-white text-primary rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Get Started Now
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="#services" class="h-16 px-8 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-primary">
                        Explore Services
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div>
                        <div class="text-4xl font-bold text-white mb-1">500+</div>
                        <div class="text-white/80 text-sm uppercase tracking-wider">Clients</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-white mb-1">98%</div>
                        <div class="text-white/80 text-sm uppercase tracking-wider">Success Rate</div>
                    </div>
                    <div>
                        <div class="text-4xl font-bold text-white mb-1">15+</div>
                        <div class="text-white/80 text-sm uppercase tracking-wider">Years Exp</div>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image/Illustration -->
            <div class="relative">
                <div class="relative z-10">
                    <img src="{{ asset('public/assets/images/reception.jpg') }}" alt="Marketing Dashboard" class="rounded-lg w-full">
                </div>
                <!-- Decorative elements -->
                <div class="absolute -top-6 -right-6 w-24 h-24 bg-accent rounded-lg"></div>
                <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-secondary rounded-lg"></div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section id="about" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative">
                <img src="{{ asset('public/assets/images/specialist.jpg') }}" alt="Team Meeting" class="rounded-lg w-full">
                <div class="absolute -bottom-8 -right-8 w-32 h-32 bg-primary rounded-lg hidden lg:block"></div>
                <div class="absolute -top-8 -left-8 w-24 h-24 bg-secondary rounded-lg hidden lg:block"></div>
            </div>
            
            <div>
                <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">About Al-Falah</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">
                    We Are Your Growth Partner
                </h2>
                
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Since 2009, we've been helping businesses scale through strategic digital marketing. Our team of experts combines creativity with data analytics to deliver campaigns that don't just look good—they perform.
                </p>
                
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    From startups to Fortune 500 companies, we've partnered with brands across industries to achieve remarkable growth and establish market dominance.
                </p>
                
                <div class="grid grid-cols-2 gap-6 mb-8">
                    <div class="bg-muted rounded-lg p-6">
                        <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-award text-white text-2xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-dark mb-2">Award Winning</h4>
                        <p class="text-gray-600 text-sm">Recognized industry leader</p>
                    </div>
                    
                    <div class="bg-muted rounded-lg p-6">
                        <div class="w-14 h-14 bg-secondary rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-dark mb-2">Expert Team</h4>
                        <p class="text-gray-600 text-sm">50+ marketing specialists</p>
                    </div>
                </div>
                
                <a href="#contact" class="inline-flex items-center justify-center h-14 px-8 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider transition-all duration-200 hover:scale-105 hover:bg-blue-600">
                    Partner With Us
                </a>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<section id="services" class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">What We Do</span>
            </div>
            
            <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">
                Our Services
            </h2>
            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Comprehensive digital marketing solutions tailored to your business goals
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
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

<!-- PORTFOLIO SECTION -->
<section id="portfolio" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">
                    Our Work
                </span>
            </div>

            <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">
                Success Stories
            </h2>

            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Real results from real clients. See how we've transformed businesses across industries.
            </p>
        </div>

        <!-- Portfolio Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($projects as $project)

                <div class="group cursor-pointer">

                    <div class="relative overflow-hidden rounded-lg mb-6">

                        <img src="{{ asset('storage/public/' . $project->image) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">

                        <div class="absolute inset-0 bg-primary/90 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">

                            <div class="text-center text-white p-6">

                                <h4 class="text-xl font-bold mb-2">
                                    {{ $project->title }}
                                </h4>

                                @if($project->badge_text)
                                    <p class="mb-4">
                                        {{ $project->badge_text }}
                                    </p>
                                @endif

                                @if($project->project_url)
                                    <a href="{{ $project->project_url }}"
                                       target="_blank"
                                       class="inline-flex items-center text-white font-semibold">
                                        View Project
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                @else
                                    <span class="inline-flex items-center text-white font-semibold">
                                        View Details
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                    <div class="inline-block px-3 py-1 bg-primary/10 rounded-md mb-2">
                        <span class="text-primary font-semibold text-xs uppercase">
                            {{ $project->category }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-dark mb-2">
                        {{ $project->title }}
                    </h3>

                    <p class="text-gray-600">
                        {{ \Illuminate\Support\Str::limit($project->description, 80) }}
                    </p>

                </div>

            @empty

                <div class="col-span-3 text-center py-16">
                    <i class="fas fa-folder-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">
                        No Projects Found
                    </h3>
                    <p class="text-gray-500">
                        Projects will appear here once added from the admin panel.
                    </p>
                </div>

            @endforelse

        </div>

        <!-- Button -->
        @if($projects->count())
            <div class="text-center mt-12">
                <a href="{{ route('portfolio') }}"
                   class="inline-flex items-center justify-center h-14 px-8 border-4 border-primary text-primary rounded-md font-bold text-sm uppercase tracking-wider transition-all duration-200 hover:bg-primary hover:text-white">
                    View All Projects
                </a>
            </div>
        @endif

    </div>
</section>

<!-- BLOG SECTION -->
<section id="blog" class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Insights</span>
            </div>
            
            <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">
                Latest From Our Blog
            </h2>
            
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Stay ahead with expert marketing insights, trends, and actionable strategies
            </p>
        </div>
        
        <!-- Check if blogs exist in the database -->
        @if($blogs->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500 text-lg">No articles published yet. Check back soon!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <!-- Dynamic Blog Post -->
                    <article class="bg-white rounded-lg overflow-hidden group cursor-pointer transition-all duration-200 hover:scale-[1.02] flex flex-col h-full">
                        <div class="relative overflow-hidden aspect-[16/10]">
                            <!-- Blog Image -->
                            @if($blog->image)
                                <img src="{{ asset('storage/public/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform duration-200 group-hover:scale-105">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                            @endif
                            
                            <!-- Blog Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-primary text-white rounded-md text-xs font-bold uppercase">
                                    {{ $blog->category ?? 'Marketing' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="far fa-calendar mr-2"></i>
                                <span>{{ $blog->created_at->format('M d, Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $blog->read_time ?? '5 Min Read' }}</span>
                            </div>
                            
                            <!-- Title -->
                            <h3 class="text-xl font-bold text-dark mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                {{ $blog->title }}
                            </h3>
                            
                            <!-- Content Excerpt -->
                            <p class="text-gray-600 mb-4 line-clamp-3 flex-1">
                                {{ Str::limit(strip_tags($blog->content), 120) }}
                            </p>
                            
                            <!-- Action Link (points to the show route via slug) -->
                            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center text-primary font-semibold group-hover:text-blue-600 transition-colors mt-auto">
                                Read More <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
        
        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center justify-center h-14 px-8 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider transition-all duration-200 hover:scale-105 hover:bg-blue-600">
                View All Articles
            </a>
        </div>
    </div>
</section>

<!-- CONTACT SECTION -->
<section id="contact" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Success Message Alert -->
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <div>
                <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                    <span class="text-primary font-semibold text-sm uppercase tracking-wider">Get In Touch</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-bold text-dark mb-6 tracking-tighter">
                    Let's Grow Your Business Together
                </h2>
                
                <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                    Ready to transform your digital presence? Get in touch with our team for a free consultation and custom strategy.
                </p>
                
                <div class="space-y-6 mb-8">
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-white text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-dark mb-1">Phone</h4>
                            <p class="text-gray-600">+1 2402806137</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-secondary rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-white text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-dark mb-1">Email</h4>
                            <p class="text-gray-600">info@al-falahmarketing.com</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-14 h-14 bg-accent rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-dark mb-1">Office</h4>
                            <p class="text-gray-600">8468 Winding Trail, Laurel, MD 20724, USA</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-4">
                    <a href="#" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            
            <div class="bg-muted rounded-lg p-8">
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">First Name</label>
                            <input type="text" name="first_name" required value="{{ old('first_name') }}" class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all" placeholder="John">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Last Name</label>
                            <input type="text" name="last_name" required value="{{ old('last_name') }}" class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all" placeholder="Doe">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}" class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all" placeholder="john@example.com">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all" placeholder="+1 (555) 000-0000">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Service Interest</label>
                        <select name="service_interest" class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                            <option value="Web Development" {{ old('service_interest') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                            <option value="Digital Marketing" {{ old('service_interest') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                            <option value="Branding & Design" {{ old('service_interest') == 'Branding & Design' ? 'selected' : '' }}>Branding & Design</option>
                            <option value="AI & Automation" {{ old('service_interest') == 'AI & Automation' ? 'selected' : '' }}>AI & Automation</option>
                            <option value="Content Creation" {{ old('service_interest') == 'Content Creation' ? 'selected' : '' }}>Content Creation</option>
                            <option value="IT Solutions" {{ old('service_interest') == 'IT Solutions' ? 'selected' : '' }}>IT Solutions</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Message</label>
                        <textarea name="message" rows="4" required class="w-full bg-white rounded-md px-4 py-3 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all resize-none" placeholder="Tell us about your project...">{{ old('message') }}</textarea>
                    </div>
                    
                    <button type="submit" class="w-full h-16 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider transition-all duration-200 hover:scale-105 hover:bg-blue-600">
                        Send Message
                        <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-accent relative overflow-hidden">
    <!-- Decorative Shapes -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready To Accelerate Your Growth?
        </h2>
        
        <p class="text-xl text-white/90 mb-10 leading-relaxed">
            Join 500+ businesses that trust MarketPro to deliver exceptional marketing results. Let's build something amazing together.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-white text-accent rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Get Free Consultation
            </a>
            <a href="#portfolio" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-accent">
                View Our Work
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
<script>
    // Smooth scroll with offset for fixed header
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 80;
                const targetPosition = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
@endsection