@extends('User.main')

@section('title', 'IT Solutions Services - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .service-card {
        transition: all 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .solution-card {
        transition: all 0.3s ease;
    }
    .solution-card:hover {
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
        background: #fffbeb;
    }
    .tech-badge {
        transition: all 0.3s ease;
    }
    .tech-badge:hover {
        transform: scale(1.05);
        background: #f59e0b !important;
        color: white !important;
    }
    .service-icon {
        transition: all 0.3s ease;
    }
    .service-card:hover .service-icon {
        transform: rotate(10deg) scale(1.1);
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
                    <span class="text-white font-semibold text-sm uppercase tracking-wider">IT Solutions</span>
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
                    Reliable IT Solutions for <span class="text-primary">Business Growth</span>
                </h1>
                <p class="text-lg text-white/90 mb-8 leading-relaxed">
                    From secure cloud hosting to enterprise IT management — we provide the technology infrastructure 
                    and support you need to scale your business with confidence.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#consultation-form" class="h-14 px-8 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                        Get IT Support
                    </a>
                    <a href="#solutions" class="h-14 px-8 border-2 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-accent">
                        Explore Solutions
                    </a>
                </div>
            </div>
            <div class="hidden lg:block">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-cloud-upload-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Cloud Hosting</p>
                                <p class="text-white/70 text-sm">99.9% Uptime Guarantee</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Cyber Security</p>
                                <p class="text-white/70 text-sm">Enterprise-grade protection</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-headset text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">24/7 Tech Support</p>
                                <p class="text-white/70 text-sm">Round-the-clock assistance</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                                <i class="fas fa-rocket text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-white font-bold">Scalable Solutions</p>
                                <p class="text-white/70 text-sm">Grow without limits</p>
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
                <div class="text-4xl font-bold text-accent">99.9%</div>
                <p class="text-gray-600 text-sm mt-1">Uptime Guarantee</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-accent">24/7</div>
                <p class="text-gray-600 text-sm mt-1">Tech Support</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-accent">500+</div>
                <p class="text-gray-600 text-sm mt-1">Servers Managed</p>
            </div>
            <div class="text-center stat-item">
                <div class="text-4xl font-bold text-accent">100%</div>
                <p class="text-gray-600 text-sm mt-1">Client Satisfaction</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY IT SOLUTIONS -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Why IT Solutions</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Technology That <span class="text-accent">Drives Growth</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Reliable IT infrastructure and support are essential for modern businesses to operate efficiently and scale.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-server text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Reliable Infrastructure</h4>
                <p class="text-gray-600">Enterprise-grade hosting and infrastructure that ensures your business runs smoothly 24/7.</p>
            </div>
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-lock text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Security First</h4>
                <p class="text-gray-600">Advanced security measures to protect your data, systems, and customer information from threats.</p>
            </div>
            <div class="benefit-item bg-white p-8 rounded-2xl shadow-sm">
                <div class="w-16 h-16 bg-accent/10 text-accent rounded-xl flex items-center justify-center mb-6">
                    <i class="fas fa-chart-line text-3xl"></i>
                </div>
                <h4 class="text-xl font-bold text-dark mb-3">Scalable Solutions</h4>
                <p class="text-gray-600">IT solutions that grow with your business, allowing you to scale without technical limitations.</p>
            </div>
        </div>
    </div>
</section>

<!-- IT SOLUTIONS SERVICES -->
<section id="solutions" class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">IT Services</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Comprehensive <span class="text-accent">IT Solutions</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We provide end-to-end IT services to keep your business running smoothly and securely.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Cloud Hosting -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-cloud-upload-alt text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Cloud Hosting</h3>
                <p class="text-gray-600 mb-4">Secure, scalable cloud hosting solutions with 99.9% uptime guarantee and lightning-fast performance.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Managed Cloud Servers</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> AWS & Google Cloud</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Automatic Backups</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Load Balancing</li>
                </ul>
            </div>

            <!-- Cyber Security -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-shield-alt text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Cyber Security</h3>
                <p class="text-gray-600 mb-4">Enterprise-grade security solutions to protect your business from cyber threats and data breaches.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Network Security</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Malware Protection</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Data Encryption</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Security Audits</li>
                </ul>
            </div>

            <!-- Tech Support -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-headset text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Tech Support</h3>
                <p class="text-gray-600 mb-4">24/7 technical support to resolve issues quickly and keep your business operations running smoothly.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> 24/7 Helpdesk</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Remote Support</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Hardware Support</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Software Updates</li>
                </ul>
            </div>

            <!-- Network Management -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-network-wired text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Network Management</h3>
                <p class="text-gray-600 mb-4">Comprehensive network management services to ensure your business connectivity is always reliable.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Network Monitoring</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> VPN Setup</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Firewall Management</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Bandwidth Optimization</li>
                </ul>
            </div>

            <!-- Data Backup & Recovery -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-database text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">Data Backup & Recovery</h3>
                <p class="text-gray-600 mb-4">Automated backup solutions and disaster recovery plans to protect your critical business data.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Automated Backups</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Disaster Recovery</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Data Restoration</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Business Continuity</li>
                </ul>
            </div>

            <!-- IT Consulting -->
            <div class="service-card bg-muted p-8 rounded-2xl border-b-8 border-accent">
                <div class="w-16 h-16 bg-accent rounded-xl flex items-center justify-center mb-6 service-icon">
                    <i class="fas fa-chart-pie text-white text-3xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-dark mb-3">IT Consulting</h3>
                <p class="text-gray-600 mb-4">Expert IT consulting services to help you make strategic technology decisions and optimize your infrastructure.</p>
                <ul class="space-y-2 text-sm text-gray-700">
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Technology Strategy</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Infrastructure Planning</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Digital Transformation</li>
                    <li><i class="fas fa-check-circle text-accent mr-2"></i> Technology Assessments</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- TECHNOLOGY STACK -->
<section class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Technology Stack</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">Enterprise-Grade <span class="text-accent">Technology</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                We use cutting-edge technology to deliver reliable and secure IT solutions.
            </p>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">AWS</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Google Cloud</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Azure</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Linux</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Windows Server</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Docker</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Kubernetes</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Cisco</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">VMware</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Fortinet</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Palo Alto</span>
            <span class="tech-badge px-6 py-3 bg-white rounded-full text-dark font-semibold shadow-sm">Zabbix</span>
        </div>
    </div>
</section>

<!-- PROCESS SECTION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Our Process</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">How We Deliver <span class="text-accent">IT Solutions</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                A systematic approach to implementing and managing your IT infrastructure.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">1</div>
                <h4 class="text-xl font-bold text-dark mb-2">Assessment</h4>
                <p class="text-gray-600 text-sm">We analyze your current IT infrastructure and identify areas for improvement and optimization.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">2</div>
                <h4 class="text-xl font-bold text-dark mb-2">Strategy</h4>
                <p class="text-gray-600 text-sm">We develop a customized IT strategy aligned with your business goals and growth plans.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">3</div>
                <h4 class="text-xl font-bold text-dark mb-2">Implementation</h4>
                <p class="text-gray-600 text-sm">We deploy and configure your IT solutions with minimal disruption to your business operations.</p>
            </div>
            <div class="process-step text-center">
                <div class="w-16 h-16 bg-accent text-white rounded-full flex items-center justify-center mx-auto mb-4 text-2xl font-bold">4</div>
                <h4 class="text-xl font-bold text-dark mb-2">Management</h4>
                <p class="text-gray-600 text-sm">We provide ongoing monitoring, maintenance, and support to ensure optimal performance.</p>
            </div>
        </div>
    </div>
</section>

<!-- PORTFOLIO SECTION -->
<section id="portfolio" class="py-20 lg:py-32 bg-muted">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-white rounded-md mb-6">
                <span class="text-accent font-semibold text-sm uppercase tracking-wider">Case Studies</span>
            </div>
            <h2 class="text-4xl font-bold text-dark mb-4 tracking-tighter">IT Solutions <span class="text-accent">Success Stories</span></h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                See how we've helped businesses improve their IT infrastructure and operations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center text-xl">
                        <i class="fas fa-cloud"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-bold text-dark">Cloud Migration</h4>
                        <p class="text-sm text-gray-500">E-commerce Company</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Successfully migrated 100+ servers to cloud infrastructure with zero downtime and 40% cost savings.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center text-xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-bold text-dark">Security Overhaul</h4>
                        <p class="text-sm text-gray-500">Financial Services</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Implemented enterprise-grade security system, reducing vulnerabilities by 95% and passing compliance audits.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-accent/10 text-accent rounded-lg flex items-center justify-center text-xl">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-bold text-dark">IT Support</h4>
                        <p class="text-sm text-gray-500">Healthcare Provider</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm">Provided 24/7 IT support, reducing system downtime by 90% and improving response times by 75%.</p>
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
                    <h4 class="text-lg font-bold text-dark">What IT services do you offer?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We offer a comprehensive range of IT services including cloud hosting, cyber security, tech support, network management, data backup and recovery, and IT consulting.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Do you provide 24/7 IT support?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, we offer 24/7 technical support for all our clients. Our team is available round-the-clock to resolve any issues and ensure your business operations run smoothly.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can you help with cloud migration?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Absolutely! We specialize in cloud migration services, helping businesses transition to cloud infrastructure with minimal downtime and maximum efficiency.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">How do you ensure data security?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>We implement enterprise-grade security measures including firewalls, encryption, intrusion detection, regular security audits, and employee training to protect your data.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question flex justify-between items-center" onclick="toggleFAQ(this)">
                    <h4 class="text-lg font-bold text-dark">Can you customize IT solutions for my business?</h4>
                    <i class="fas fa-chevron-down text-accent transition-transform"></i>
                </div>
                <div class="faq-answer text-gray-600 mt-2">
                    <p>Yes, all our IT solutions are customized to meet your specific business needs. We assess your current infrastructure and develop tailored solutions that align with your goals.</p>
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
            Ready to Secure Your Business Technology?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            Let's implement IT solutions that keep your business running smoothly, securely, and efficiently.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#consultation-form" class="h-16 px-10 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Get IT Support
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
                    <h3 class="text-3xl font-bold mb-6">Book a Free IT Consultation</h3>
                    <p class="mb-8 text-white/80">Let's discuss your IT needs and create a strategy that ensures your business technology is reliable, secure, and scalable.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> 30-Min Strategy Session</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Infrastructure Assessment</li>
                        <li class="flex items-center"><i class="fas fa-check-circle mr-3"></i> Custom IT Roadmap</li>
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
                            <textarea name="subject" rows="3" required class="w-full border-b-2 border-gray-200 focus:border-accent outline-none transition-colors resize-none" placeholder="Tell us about your IT needs..."></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-accent text-white rounded-md font-bold uppercase tracking-widest hover:bg-orange-600 transition-all transform hover:scale-[1.02]">
                            Book Free IT Consultation
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