@extends('User.main')

@section('title', 'Terms & Conditions - Al-Falah Digital Marketing Agency')

@section('styles')
<style>
    .terms-section {
        scroll-margin-top: 100px;
    }
    .terms-card {
        transition: all 0.3s ease;
    }
    .terms-card:hover {
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
<section class="relative bg-secondary overflow-hidden pt-32 pb-20 lg:pt-40 lg:pb-32">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-6">
            <span class="text-white font-semibold text-sm uppercase tracking-wider">Legal</span>
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight tracking-tighter">
            Terms & <span class="text-accent">Conditions</span>
        </h1>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed">
            Please read these terms carefully before using our website and services.
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
                        <li><a href="#acceptance" class="toc-link text-gray-600 text-sm block">1. Acceptance of Terms</a></li>
                        <li><a href="#services" class="toc-link text-gray-600 text-sm block">2. Services</a></li>
                        <li><a href="#user-obligations" class="toc-link text-gray-600 text-sm block">3. User Obligations</a></li>
                        <li><a href="#payment" class="toc-link text-gray-600 text-sm block">4. Payment Terms</a></li>
                        <li><a href="#intellectual-property" class="toc-link text-gray-600 text-sm block">5. Intellectual Property</a></li>
                        <li><a href="#confidentiality" class="toc-link text-gray-600 text-sm block">6. Confidentiality</a></li>
                        <li><a href="#warranties" class="toc-link text-gray-600 text-sm block">7. Warranties & Disclaimer</a></li>
                        <li><a href="#liability" class="toc-link text-gray-600 text-sm block">8. Limitation of Liability</a></li>
                        <li><a href="#termination" class="toc-link text-gray-600 text-sm block">9. Termination</a></li>
                        <li><a href="#governing-law" class="toc-link text-gray-600 text-sm block">10. Governing Law</a></li>
                        <li><a href="#changes" class="toc-link text-gray-600 text-sm block">11. Changes to Terms</a></li>
                        <li><a href="#contact-terms" class="toc-link text-gray-600 text-sm block">12. Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Terms Content -->
            <div class="lg:col-span-3 space-y-8">
                <!-- Section 1 -->
                <div id="acceptance" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">1. Acceptance of Terms</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            By accessing and using the website and services of <strong>Al-Falah Digital Marketing Agency</strong> ("we," "us," or "our"), you agree to be bound by these Terms and Conditions. If you do not agree with any part of these terms, please do not use our website or services.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            These terms apply to all visitors, users, and others who access or use our services.
                        </p>
                    </div>
                </div>

                <!-- Section 2 -->
                <div id="services" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">2. Services</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We provide digital marketing services including but not limited to:
                        </p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">Website Development & Design</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">Search Engine Optimization (SEO)</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">Social Media Marketing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">Content Creation & Marketing</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">AI & Automation Solutions</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <span class="text-gray-600">IT Solutions & Support</span>
                            </li>
                        </ul>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            Specific services and deliverables will be outlined in individual service agreements or proposals.
                        </p>
                    </div>
                </div>

                <!-- Section 3 -->
                <div id="user-obligations" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">3. User Obligations</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed font-semibold">As a user of our services, you agree to:</p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Provide Accurate Information:</span>
                                    <span class="text-gray-600"> You must provide accurate and complete information when using our services.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Comply with Laws:</span>
                                    <span class="text-gray-600"> You must comply with all applicable laws and regulations.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Prohibited Activities:</span>
                                    <span class="text-gray-600"> You may not use our services for any illegal or unauthorized purpose.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Security:</span>
                                    <span class="text-gray-600"> You must maintain the security of your account and passwords.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 4 -->
                <div id="payment" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">4. Payment Terms</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            Payment terms for our services are as follows:
                        </p>
                        <ul class="mt-4 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Fees:</span>
                                    <span class="text-gray-600"> Service fees are outlined in individual proposals or contracts.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Payment Schedule:</span>
                                    <span class="text-gray-600"> Payments are due as specified in the service agreement.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Late Payments:</span>
                                    <span class="text-gray-600"> Late payments may incur additional fees or suspension of services.</span>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle text-secondary mt-1 mr-3"></i>
                                <div>
                                    <span class="font-bold text-dark">Refund Policy:</span>
                                    <span class="text-gray-600"> Refunds are handled according to the terms specified in the service agreement.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 5 -->
                <div id="intellectual-property" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">5. Intellectual Property</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            All content, designs, logos, trademarks, and intellectual property on our website and services are owned by or licensed to <strong>Al-Falah Digital Marketing Agency</strong>.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            You may not reproduce, distribute, modify, or create derivative works of our intellectual property without our express written consent.
                        </p>
                        <div class="mt-4 p-4 bg-white rounded-lg">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-info-circle text-primary mr-2"></i>
                                Work created for clients during service delivery will be owned by the client upon full payment, subject to the terms of the service agreement.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 6 -->
                <div id="confidentiality" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">6. Confidentiality</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            Both parties agree to maintain the confidentiality of all proprietary information shared during the course of our engagement.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            Confidential information includes but is not limited to business strategies, customer data, financial information, and any other sensitive information.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            This confidentiality obligation survives the termination of our engagement.
                        </p>
                    </div>
                </div>

                <!-- Section 7 -->
                <div id="warranties" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">7. Warranties & Disclaimer</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We provide our services "as is" and make no warranties or representations about the accuracy, reliability, or completeness of our services.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            We do not guarantee specific results from our marketing services, as outcomes depend on various factors beyond our control.
                        </p>
                        <div class="mt-4 p-4 bg-white rounded-lg border-l-4 border-secondary">
                            <p class="text-sm text-gray-600">
                                <i class="fas fa-exclamation-triangle text-secondary mr-2"></i>
                                While we strive for excellence, we cannot guarantee that our services will meet all your expectations or be uninterrupted or error-free.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 8 -->
                <div id="liability" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">8. Limitation of Liability</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            To the maximum extent permitted by law, <strong>Al-Falah Digital Marketing Agency</strong> shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            Our total liability for any claim arising out of or relating to our services shall not exceed the total amount paid by you for such services.
                        </p>
                        <div class="mt-4 p-4 bg-white rounded-lg">
                            <p class="text-sm text-gray-500">
                                <i class="fas fa-gavel text-secondary mr-2"></i>
                                This limitation of liability applies to all claims, whether based on warranty, contract, tort, or any other legal theory.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Section 9 -->
                <div id="termination" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">9. Termination</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We may terminate or suspend your access to our services at any time, without prior notice, for conduct that we believe violates these terms or is harmful to other users or our business.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            Upon termination, your right to use our services will immediately cease. You may also terminate our engagement by providing written notice as specified in your service agreement.
                        </p>
                    </div>
                </div>

                <!-- Section 10 -->
                <div id="governing-law" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">10. Governing Law</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            These Terms and Conditions shall be governed by and construed in accordance with the laws of the United States, without regard to its conflict of law provisions.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            Any disputes arising from these terms shall be resolved in the courts of the United States.
                        </p>
                    </div>
                </div>

                <!-- Section 11 -->
                <div id="changes" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">11. Changes to Terms</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            We reserve the right to update or modify these Terms and Conditions at any time. Changes will be effective immediately upon posting on this page.
                        </p>
                        <p class="text-gray-600 leading-relaxed mt-4">
                            We encourage you to review these terms periodically for any changes. Your continued use of our services constitutes acceptance of the updated terms.
                        </p>
                    </div>
                </div>

                <!-- Section 12 -->
                <div id="contact-terms" class="terms-section">
                    <h2 class="text-2xl font-bold text-dark mb-4">12. Contact Us</h2>
                    <div class="terms-card bg-muted p-6 rounded-xl">
                        <p class="text-gray-600 leading-relaxed">
                            If you have any questions about these Terms and Conditions, please contact us:
                        </p>
                        <div class="mt-6 space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-secondary w-8"></i>
                                <span class="text-gray-600">info@al-falahmarketing.com</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-secondary w-8"></i>
                                <span class="text-gray-600">+1 (240) 280-6137</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-map-marker-alt text-secondary w-8"></i>
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
<section class="py-20 lg:py-32 bg-secondary relative overflow-hidden">
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/5 rounded-full translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 tracking-tighter">
            Questions About Our Terms?
        </h2>
        <p class="text-xl text-white/80 mb-10 leading-relaxed">
            We're here to clarify any questions you have about our terms and conditions.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#contact-terms" class="h-16 px-10 bg-accent text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:scale-105">
                Contact Us
            </a>
            <a href="https://wa.me/{{ \App\Support\Contact::whatsapp() }}" class="h-16 px-10 border-4 border-white text-white rounded-md font-bold text-sm uppercase tracking-wider inline-flex items-center justify-center transition-all duration-200 hover:bg-white hover:text-secondary">
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
    const sections = document.querySelectorAll('.terms-section');
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