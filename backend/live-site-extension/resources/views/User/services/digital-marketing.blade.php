@extends('User.main')

@section('title', 'Digital Marketing Services - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .stat-counter {
        transition: all 0.3s ease;
    }
    .stat-counter:hover {
        transform: scale(1.05);
    }
    .marketing-card {
        transition: all 0.3s ease;
    }
    .marketing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .strategy-step {
        position: relative;
    }
    .strategy-step:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 24px;
        top: 60px;
        bottom: 0;
        width: 2px;
        background: #10b981;
        opacity: 0.3;
    }
    .pricing-card {
        transition: all 0.3s ease;
    }
    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    .pricing-card.featured {
        border: 2px solid #10b981;
        position: relative;
    }
    .pricing-card.featured::before {
        content: 'Best Value';
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #10b981;
        color: white;
        padding: 4px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }
    .channel-item {
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }
    .channel-item:hover {
        border-color: #10b981;
        background: #f0fdf4;
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
        color: #10b981;
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    .faq-answer.open {
        max-height: 200px;
    }
    .case-study {
        transition: all 0.3s ease;
    }
    .case-study:hover {
        transform: scale(1.02);
    }
</style>
@endsection

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-secondary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">Digital Marketing</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Grow Your Business With <span class="text-accent">Data-Driven Marketing</span>
                </h1>
                <p class="text-lg text-white/90 mb-8 leading-relaxed">
                    From SEO and Google Ads to social media and email marketing — we create comprehensive digital strategies 
                    that drive real results for your business.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#consultation-form" class="h-14 px-8 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Start Growing Today
                    </a>
                    <a href="#strategies" class="h-14 px-8 border-2 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-secondary">
                        View Strategies
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-accent">200+</div>
                            <p class="text-white/80 text-sm mt-1">Happy Clients</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-accent">95%</div>
                            <p class="text-white/80 text-sm mt-1">Client Retention</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-accent">300%</div>
                            <p class="text-white/80 text-sm mt-1">Average ROI</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-accent">4.9★</div>
                            <p class="text-white/80 text-sm mt-1">Client Rating</p>
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
            <div class="text-center stat-counter">
                <div class="text-4xl font-bold text-secondary">$10M+</div>
                <p class="text-gray-600 text-sm mt-1">Revenue Generated</p>
            </div>
            <div class="text-center stat-counter">
                <div class="text-4xl font-bold text-secondary">50K+</div>
                <p class="text-gray-600 text-sm mt-1">Leads Generated</p>
            </div>
            <div class="text-center stat-counter">
                <div class="text-4xl font-bold text-secondary">1000+</div>
                <p class="text-gray-600 text-sm mt-1">Campaigns Run</p>
            </div>
            <div class="text-center stat-counter">
                <div class="text-4xl font-bold text-secondary">8+</div>
                <p class="text-gray-600 text-sm mt-1">Years Experience</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY DIGITAL MARKETING -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Why Digital Marketing</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Why Your Business Needs <span class="text-secondary">Digital Marketing</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                In today's digital-first world, having a strong online presence is essential for business growth.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Targeted Reach</h4>
                <p class="text-gray-600">Reach exactly the right audience at the right time with precision targeting based on demographics, interests, and behavior.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Measurable Results</h4>
                <p class="text-gray-600">Track every click, conversion, and dollar spent with detailed analytics. Know exactly what's working and optimize in real-time.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-secondary/10 text-secondary rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-wallet text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Cost-Effective</h4>
                <p class="text-gray-600">Compared to traditional advertising, digital marketing offers better ROI with lower entry costs and flexible budget options.</p>
            </div>
        </div>
    </div>
</section>

<!-- MARKETING CHANNELS -->
<section id="strategies" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Marketing Channels</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Multi-Channel Marketing <span class="text-secondary">Approach</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We leverage multiple channels to create a comprehensive marketing ecosystem that drives results.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- SEO -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-search text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">SEO & Search Marketing</h4>
                        <p class="text-gray-600 text-sm mt-1">Get found on Google with organic search optimization and local SEO strategies.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Keyword Research & Optimization</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> On-Page & Off-Page SEO</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Local Business Listings</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- PPC Ads -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-ad text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">PPC & Paid Advertising</h4>
                        <p class="text-gray-600 text-sm mt-1">Drive immediate traffic and leads with targeted Google Ads and social media campaigns.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Google Ads Management</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Social Media Advertising</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Retargeting Campaigns</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fab fa-facebook text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">Social Media Marketing</h4>
                        <p class="text-gray-600 text-sm mt-1">Build brand awareness and engage with your audience across all major platforms.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Content Strategy & Creation</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Community Management</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Influencer Partnerships</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Email Marketing -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">Email Marketing</h4>
                        <p class="text-gray-600 text-sm mt-1">Nurture leads and build lasting relationships with targeted email campaigns.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Newsletter Campaigns</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Automated Sequences</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Lead Nurturing</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content Marketing -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-pen-fancy text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">Content Marketing</h4>
                        <p class="text-gray-600 text-sm mt-1">Create valuable content that attracts, engages, and converts your target audience.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Blog Post Creation</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Video Production</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Infographics & Visuals</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Analytics -->
            <div class="channel-item p-6 rounded-xl bg-white">
                <div class="flex items-start">
                    <div class="w-14 h-14 bg-secondary/10 text-secondary rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-chart-pie text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-dark">Analytics & Reporting</h4>
                        <p class="text-gray-600 text-sm mt-1">Data-driven decisions with detailed reporting and actionable insights.</p>
                        <ul class="mt-3 space-y-1 text-sm text-gray-700">
                            <li><i class="fas fa-check text-secondary mr-2"></i> Performance Tracking</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> ROI Analysis</li>
                            <li><i class="fas fa-check text-secondary mr-2"></i> Strategy Optimization</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- STRATEGY SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Our Strategy</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">How We Drive <span class="text-secondary">Results</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A proven process that delivers consistent growth for our clients.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="strategy-step text-center">
                <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                <h4 class="text-xl font-bold text-dark mb-2">Research</h4>
                <p class="text-gray-600 text-sm">Deep market research to understand your audience, competitors, and opportunities.</p>
            </div>
            <div class="strategy-step text-center">
                <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                <h4 class="text-xl font-bold text-dark mb-2">Strategy</h4>
                <p class="text-gray-600 text-sm">Custom marketing plan tailored to your goals, budget, and target audience.</p>
            </div>
            <div class="strategy-step text-center">
                <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                <h4 class="text-xl font-bold text-dark mb-2">Execution</h4>
                <p class="text-gray-600 text-sm">Launch campaigns across multiple channels with precision and expertise.</p>
            </div>
            <div class="strategy-step text-center">
                <div class="w-16 h-16 bg-secondary text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                <h4 class="text-xl font-bold text-dark mb-2">Optimize</h4>
                <p class="text-gray-600 text-sm">Continuously monitor, analyze, and optimize for maximum performance and ROI.</p>
            </div>
        </div>
    </div>
</section>

<!-- CASE STUDIES -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Success Stories</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Real Results for <span class="text-secondary">Real Businesses</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                See how we've helped businesses like yours achieve remarkable growth.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="case-study bg-muted p-6 rounded-2xl">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-full flex items-center justify-center text-xl font-bold">+</div>
                    <div class="ml-3">
                        <div class="text-2xl font-bold text-secondary">300%</div>
                        <p class="text-sm text-gray-600">Increase in Leads</p>
                    </div>
                </div>
                <p class="text-gray-700 text-sm">A local HVAC company tripled their lead generation through targeted Google Ads and SEO optimization.</p>
            </div>
            <div class="case-study bg-muted p-6 rounded-2xl">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-full flex items-center justify-center text-xl font-bold">+</div>
                    <div class="ml-3">
                        <div class="text-2xl font-bold text-secondary">150%</div>
                        <p class="text-sm text-gray-600">Increase in Sales</p>
                    </div>
                </div>
                <p class="text-gray-700 text-sm">An e-commerce store doubled their revenue through social media advertising and email marketing campaigns.</p>
            </div>
            <div class="case-study bg-muted p-6 rounded-2xl">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-secondary/10 text-secondary rounded-full flex items-center justify-center text-xl font-bold">+</div>
                    <div class="ml-3">
                        <div class="text-2xl font-bold text-secondary">500%</div>
                        <p class="text-sm text-gray-600">Increase in Traffic</p>
                    </div>
                </div>
                <p class="text-gray-700 text-sm">A SaaS company achieved 5x growth in organic traffic through comprehensive SEO and content marketing.</p>
            </div>
        </div>
    </div>
</section>

<!-- TOOLS & TECHNOLOGIES -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">Tools & Technologies</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Marketing Tools We <span class="text-secondary">Use & Trust</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We leverage industry-leading tools to deliver the best results for our clients.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Google Analytics</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Google Ads</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Facebook Ads Manager</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">SEMrush</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Ahrefs</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">HubSpot</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Mailchimp</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Hootsuite</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Canva</span>
            <span class="px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Hotjar</span>
        </div>
    </div>
</section>


<!-- FAQ SECTION -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-secondary font-semibold text-sm uppercase tracking-wider">FAQ</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Frequently Asked <span class="text-secondary">Questions</span></h2>
        </div>

        <div class="space-y-2">
            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How long does it take to see results?</h4>
                    <i class="fas fa-chevron-down text-secondary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>While SEO typically takes 3-6 months to see significant results, PPC and social media ads can show results within the first few weeks. We provide regular updates and reports to track progress.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you guarantee first page rankings?</h4>
                    <i class="fas fa-chevron-down text-secondary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We guarantee to follow Google's best practices and work diligently to improve your rankings. However, no ethical SEO agency can guarantee specific rankings as Google's algorithm is constantly changing.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">What's included in your marketing packages?</h4>
                    <i class="fas fa-chevron-down text-secondary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Each package includes a combination of SEO, social media, content creation, and analytics. The specific services vary by package. Contact us for a detailed breakdown of what's included.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can I cancel my marketing services anytime?</h4>
                    <i class="fas fa-chevron-down text-secondary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, our services are month-to-month with no long-term contracts. You can cancel with 30 days notice.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you work with businesses in all industries?</h4>
                    <i class="fas fa-chevron-down text-secondary transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we work with businesses across various industries including home services, e-commerce, healthcare, real estate, and more. We adapt our strategies to your specific industry needs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="py-20 lg:py-32 bg-secondary relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Ready to Grow Your Business?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Start attracting more customers and increasing your revenue with our proven digital marketing strategies.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Get Free Consultation
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-secondary">
                Message on WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- FREE CONSULTATION SECTION -->
<section id="consultation-form" class="py-20 lg:py-32 bg-secondary relative overflow-hidden">
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-2 bg-accent p-8 text-white">
                    <h3 class="text-3xl font-bold mb-6">Book a Free Strategy Call</h3>
                    <p class="mb-8 text-white/80">Let's discuss your business goals and create a custom marketing strategy that drives results.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Strategy Session</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Competitor Analysis</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Custom Marketing Plan</li>
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
                            <input type="text" name="name" required class="w-full h-12 border-b-2 border-gray-200 focus:border-secondary outline-none transition-colors" placeholder="Enter your name">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Email Address</label>
                            <input type="email" name="email" required class="w-full h-12 border-b-2 border-gray-200 focus:border-secondary outline-none transition-colors" placeholder="email@example.com">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Preferred Meeting Date</label>
                            <input type="date" name="meeting_date" required min="{{ date('Y-m-d') }}" class="w-full h-12 border-b-2 border-gray-200 focus:border-secondary outline-none transition-colors">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-dark mb-1 uppercase">Subject / Discussion Topic</label>
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-secondary outline-none transition-colors resize-none" placeholder="Tell us about your marketing goals..."></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-secondary text-white rounded-md font-bold uppercase tracking-widest hover:bg-green-700 transition-all transform hover:scale-[1.02]">
                            Book Free Strategy Call
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