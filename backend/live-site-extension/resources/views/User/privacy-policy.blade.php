@extends('User.main')

@section('title', 'Privacy Policy - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .policy-section {
        scroll-margin-top: 100px;
    }
    .policy-card {
        transition: all 0.3s ease;
    }
    .policy-card:hover {
        transform: translateX(5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .table-of-contents {
        position: sticky;
        top: 100px;
    }
    .toc-link {
        transition: all 0.3s ease;
    }
    .toc-link:hover {
        color: #3b82f6;
        padding-left: 10px;
    }
    .toc-link.active {
        color: #3b82f6;
        font-weight: bold;
        padding-left: 10px;
        border-left: 3px solid #3b82f6;
    }
    @media (max-width: 768px) {
        .table-of-contents {
            position: relative;
            top: 0;
            margin-bottom: 30px;
        }
    }
</style>
@endsection

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-primary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
            <span class="text-white font-semibold text-sm uppercase tracking-wider">Legal</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
            Privacy <span class="text-accent">Policy</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            Your privacy matters to us. Learn how we collect, use, and protect your personal information.
        </p>
        <p class="text-sm text-white/70 mt-4">Last Updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<!-- CONTENT SECTION -->
<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Table of Contents -->
            <div class="lg:col-span-1">
                <div class="table-of-contents bg-muted p-6 rounded-2xl">
                    <h3 class="text-lg font-bold text-dark mb-4">Contents</h3>
                    <ul class="space-y-3">
                        <li><a href="#introduction" class="toc-link text-gray-600 text-sm block">1. Introduction</a></li>
                        <li><a href="#information-collect" class="toc-link text-gray-600 text-sm block">2. Information We Collect</a></li>
                        <li><a href="#how-we-use" class="toc-link text-gray-600 text-sm block">3. How We Use Your Information</a></li>
                        <li><a href="#information-share" class="toc-link text-gray-600 text-sm block">4. Information Sharing</a></li>
                        <li><a href="#cookies" class="toc-link text-gray-600 text-sm block">5. Cookies & Tracking</a></li>
                        <li><a href="#data-security" class="toc-link text-gray-600 text-sm block">6. Data Security</a></li>
                        <li><a href="#third-party" class="toc-link text-gray-600 text-sm block">7. Third-Party Services</a></li>
                        <li><a href="#children" class="toc-link text-gray-600 text-sm block">8. Children's Privacy</a></li>
                        <li><a href="#rights" class="toc-link text-gray-600 text-sm block">9. Your Rights</a></li>
                        <li><a href="#updates" class="toc-link text-gray-600 text-sm block">10. Policy Updates</a></li>
                        <li><a href="#contact" class="toc-link text-gray-600 text-sm block">11. Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Policy Content -->
            <div class="lg:col-span-3 space-y-8">
                <!-- Section 1 -->
                <div id="introduction" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">1. Introduction</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            At <strong>Al-Falah Digital Marketing Agency</strong> ("we," "us," or "our"), we are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our services.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            By using our website and services, you agree to the collection and use of information in accordance with this policy. Please read this Privacy Policy carefully.
                        </p>
                    </div>
                </div>

                <!-- Section 2 -->
                <div id="information-collect" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">2. Information We Collect</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed font-semibold">We may collect the following types of information:</p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Personal Information:</span>
                                    <span class="text-gray-600"> Name, email address, phone number, company name, and any other information you provide to us.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Usage Data:</span>
                                    <span class="text-gray-600"> Information about how you interact with our website, including pages visited, time spent, and actions taken.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Device Information:</span>
                                    <span class="text-gray-600"> IP address, browser type, operating system, and device identifiers.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Cookies:</span>
                                    <span class="text-gray-600"> We use cookies to enhance your experience and analyze website traffic.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 3 -->
                <div id="how-we-use" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">3. How We Use Your Information</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">We use your information for the following purposes:</p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Provide Services:</span>
                                    <span class="text-gray-600"> To deliver our digital marketing services and respond to your inquiries.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Communication:</span>
                                    <span class="text-gray-600"> To send you updates, newsletters, and marketing communications you've requested.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Improvement:</span>
                                    <span class="text-gray-600"> To analyze and improve our website, services, and user experience.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Legal Compliance:</span>
                                    <span class="text-gray-600"> To comply with legal obligations and protect our rights.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 4 -->
                <div id="information-share" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">4. Information Sharing</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We do not sell, trade, or rent your personal information to third parties. However, we may share your information in the following circumstances:
                        </p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Service Providers:</span>
                                    <span class="text-gray-600"> With trusted third-party vendors who assist us in operating our business.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Legal Requirements:</span>
                                    <span class="text-gray-600"> When required by law, court order, or government regulation.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-accent mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Business Transfers:</span>
                                    <span class="text-gray-600"> In connection with a merger, acquisition, or sale of assets.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 5 -->
                <div id="cookies" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">5. Cookies & Tracking</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We use cookies and similar tracking technologies to track activity on our website and hold certain information. Cookies are files with a small amount of data that are stored on your device.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our website.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            We use the following types of cookies:
                        </p>
                        <ul class="mt-4 space-y-2 text-gray-600">
                            <li>• <strong>Essential Cookies:</strong> Necessary for the website to function properly.</li>
                            <li>• <strong>Analytics Cookies:</strong> Help us understand how visitors interact with our website.</li>
                            <li>• <strong>Marketing Cookies:</strong> Used to deliver relevant advertisements.</li>
                        </ul>
                    </div>
                </div>

                <!-- Section 6 -->
                <div id="data-security" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">6. Data Security</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            However, no method of transmission over the internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your information, we cannot guarantee its absolute security.
                        </p>
                        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-white p-4 rounded-lg text-center">
                                <i class="fas fa-lock text-primary text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Encryption</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg text-center">
                                <i class="fas fa-shield-alt text-primary text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Firewall Protection</p>
                            </div>
                            <div class="bg-white p-4 rounded-lg text-center">
                                <i class="fas fa-user-shield text-primary text-2xl mb-2"></i>
                                <p class="text-sm text-gray-600 font-semibold">Access Control</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 7 -->
                <div id="third-party" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">7. Third-Party Services</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            Our website may contain links to third-party websites and services. We are not responsible for the privacy practices or content of these external sites.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            We encourage you to review the privacy policies of any third-party websites you visit.
                        </p>
                        <div class="mt-4 flex flex-wrap gap-3">
                            <span class="px-4 py-2 bg-white rounded-full text-sm text-gray-600">Google Analytics</span>
                            <span class="px-4 py-2 bg-white rounded-full text-sm text-gray-600">Facebook</span>
                            <span class="px-4 py-2 bg-white rounded-full text-sm text-gray-600">Instagram</span>
                            <span class="px-4 py-2 bg-white rounded-full text-sm text-gray-600">LinkedIn</span>
                            <span class="px-4 py-2 bg-white rounded-full text-sm text-gray-600">Twitter</span>
                        </div>
                    </div>
                </div>

                <!-- Section 8 -->
                <div id="children" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">8. Children's Privacy</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            Our services are not directed to individuals under the age of 13. We do not knowingly collect personal information from children under 13. If you are a parent or guardian and believe your child has provided us with personal information, please contact us.
                        </p>
                    </div>
                </div>

                <!-- Section 9 -->
                <div id="rights" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">9. Your Rights</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed font-semibold">You have the following rights regarding your personal information:</p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Access:</span>
                                    <span class="text-gray-600"> You can request a copy of the personal information we hold about you.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Correction:</span>
                                    <span class="text-gray-600"> You can request that we correct any inaccurate information.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Deletion:</span>
                                    <span class="text-gray-600"> You can request that we delete your personal information.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-primary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Opt-Out:</span>
                                    <span class="text-gray-600"> You can opt-out of receiving marketing communications at any time.</span>
                                </div>
                            </li>
                        </ul>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            To exercise these rights, please contact us using the information provided below.
                        </p>
                    </div>
                </div>

                <!-- Section 10 -->
                <div id="updates" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">10. Policy Updates</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new policy on this page and updating the "Last Updated" date at the top.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            We encourage you to review this Privacy Policy periodically for any changes.
                        </p>
                    </div>
                </div>

                <!-- Section 11 -->
                <div id="contact" class="policy-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">11. Contact Us</h2>
                    <div class="policy-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            If you have any questions, concerns, or requests regarding this Privacy Policy, please contact us:
                        </p>
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-primary w-8"></i>
                                <span class="text-gray-600">info@al-falahmarketing.com</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-primary w-8"></i>
                                <span class="text-gray-600">{{ \App\Support\Contact::whatsappDisplay() }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-primary w-8"></i>
                                <span class="text-gray-600">Al-Falah Marketing, USA</span>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-white rounded-lg">
                            <p class="text-sm text-gray-500">We typically respond to inquiries within 2-3 business days.</p>
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
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Have Questions About Your Privacy?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            We're here to help. Contact us for any privacy-related concerns or questions.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#contact" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Contact Us
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-primary">
                Message on WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    // Smooth scroll for table of contents links
    document.querySelectorAll('.toc-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Active link highlighting on scroll
    const sections = document.querySelectorAll('.policy-section');
    const navLinks = document.querySelectorAll('.toc-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            if (window.scrollY >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
</script>
@endsection