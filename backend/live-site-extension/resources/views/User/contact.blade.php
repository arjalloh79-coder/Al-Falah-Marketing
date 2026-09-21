@extends('User.main')

@section('title', 'Al-Falah - Digital Marketing Agency')

@section('main-section')


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
                            <p class="text-gray-600">{{ \App\Support\Contact::whatsappDisplay() }}</p>
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
                    <a href="https://www.facebook.com/profile.php?id=61573274222922" target="_blank" rel="noopener" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://youtube.com/@al-falahmarketing-official?si=tt2bDxU_qv5g8M0o" target="_blank" rel="noopener" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/al-falah-marketing-inc/" target="_blank" rel="noopener" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.instagram.com/alfalahmarketinginc/" target="_blank" rel="noopener" class="w-12 h-12 bg-muted rounded-lg flex items-center justify-center text-dark hover:bg-primary hover:text-white transition-all duration-200 hover:scale-110">
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


@endsection

