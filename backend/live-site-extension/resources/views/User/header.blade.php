<style>
    /* Header Styles */
    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background: white;
        transition: all 200ms;
    }

    .header.scrolled {
        border-bottom: 2px solid #E5E7EB;
    }

    /* Mobile menu */
    .mobile-menu {
        transform: translateX(-100%);
        transition: transform 300ms;
    }

    .mobile-menu.active {
        transform: translateX(0);
    }

    /* Services dropdown (desktop) */
    #services-menu {
        transition: opacity 150ms ease, transform 150ms ease;
    }
    @media (prefers-reduced-motion: reduce) {
        #services-menu {
            transition: none;
        }
    }
</style>

<header class="header" id="mainHeader">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('assets/images/alfalah.webp') }}" alt="Al-Falah Marketing Logo"
                    class="h-12 w-auto object-contain transition-transform duration-200 group-hover:scale-105">

                <div>
                    <span class="text-2xl font-bold text-dark tracking-tight">
                        Al-Falah
                        <span class="text-primary">Marketing</span>
                    </span>
                </div>

            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="{{ route('home') }}"
                    class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider">Home</a>
                <a href="{{ route('about') }}"
                    class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider">About</a>

                <!-- Services (dropdown) -->
                <div class="relative" id="servicesDropdown">
                    <button type="button"
                        class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider flex items-center gap-1"
                        aria-haspopup="true" aria-expanded="false" aria-controls="services-menu"
                        onclick="toggleServicesMenu(event)">
                        Services
                        <i class="fas fa-chevron-down text-xs transition-transform" id="servicesChevron"></i>
                    </button>

                    <div id="services-menu" role="menu"
                        class="absolute left-1/2 -translate-x-1/2 top-full mt-3 w-[560px] bg-white rounded-lg shadow-xl border border-gray-100 p-3 grid grid-cols-2 gap-1 opacity-0 invisible translate-y-1">
                        <a href="{{ route('services.web-development') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-code text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">Web Development</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Fast, modern sites built to convert</span>
                            </span>
                        </a>
                        <a href="{{ route('services.digital-marketing') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-bullhorn text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">Digital Marketing</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Paid & organic campaigns that grow reach</span>
                            </span>
                        </a>
                        <a href="{{ route('services.branding') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-palette text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">Branding & Design</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Identity that earns trust at a glance</span>
                            </span>
                        </a>
                        <a href="{{ route('services.automation') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-robot text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">Automation (AI)</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Save hours with AI-driven workflows</span>
                            </span>
                        </a>
                        <a href="{{ route('services.content') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-pen-nib text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">Content Creation</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Copy and creative that ships weekly</span>
                            </span>
                        </a>
                        <a href="{{ route('services.solution') }}" role="menuitem"
                            class="flex items-start gap-3 p-3 rounded-md hover:bg-muted transition-colors">
                            <i class="fas fa-server text-primary mt-1"></i>
                            <span>
                                <span class="block font-bold text-dark text-sm">IT Solutions</span>
                                <span class="block text-xs text-gray-500 mt-0.5">Reliable infrastructure behind the scenes</span>
                            </span>
                        </a>
                    </div>
                </div>

                <a href="{{ route('portfolio') }}"
                    class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider">Portfolio</a>
                <a href="{{ route('blog') }}"
                    class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider">Blog</a>
                <a href="{{ route('contact') }}"
                    class="nav-link text-sm font-semibold text-dark hover:text-primary transition-colors duration-200 uppercase tracking-wider">Contact</a>
            </nav>

            <!-- Desktop Right Side Buttons / Dashboard Icon -->
            <div class="hidden lg:flex items-center space-x-4">



                <!-- Language Switch -->
    <div class="flex items-center bg-muted rounded-md overflow-hidden border border-gray-200">
        <button onclick="setLanguage('en')" id="lang-btn-en"
            class="px-3 h-10 text-xs font-bold uppercase transition">
            🇬🇧 EN
        </button>

        <button onclick="setLanguage('fr')" id="lang-btn-fr"
            class="px-3 h-10 text-xs font-bold uppercase transition">
            🇫🇷 FR
        </button>
    </div>
                @guest
                    <!-- अगर यूजर लॉग इन नहीं है तो ये बटन दिखेंगे -->
                    <a href="{{ route('login') }}"
                        class="px-6 h-12 border-2 border-primary text-primary rounded-md font-semibold text-sm uppercase tracking-wider flex items-center justify-center transition-all duration-200 hover:bg-primary hover:text-white">
                        Login
                    </a>
                @endguest

                @auth
                    <!-- अगर यूजर लॉग इन है तो केवल उसका नाम और डैशबोर्ड लिंक आइकॉन दिखेगा -->
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.index') : route('user.dashboard') }}"
                        class="flex items-center space-x-3 px-4 h-12 bg-muted hover:bg-gray-200 text-dark rounded-md font-bold text-sm uppercase tracking-wider transition-colors duration-200">
                        <div
                            class="w-8 h-8 bg-primary text-white font-bold rounded-full flex items-center justify-center text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <i class="fas fa-arrow-right text-xs text-primary"></i>
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button class="lg:hidden w-10 h-10 bg-muted rounded-md flex items-center justify-center"
                onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-dark text-xl" id="menuIcon"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="mobile-menu fixed top-0 left-0 w-full h-full bg-white z-50 lg:hidden" id="mobileMenu">
        <div class="flex flex-col h-full">
            <div class="flex items-center justify-between p-6 border-b-2 border-gray-200">
                <span class="text-2xl font-bold text-dark tracking-tighter">MARKET<span
                        class="text-primary">PRO</span></span>
                <button class="w-10 h-10 bg-muted rounded-md flex items-center justify-center"
                    onclick="toggleMobileMenu()">
                    <i class="fas fa-times text-dark text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-6 py-8 space-y-4 overflow-y-auto">
                <a href="{{ route('home') }}" onclick="toggleMobileMenu()"
                    class="block py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider">Home</a>
                <a href="{{ route('about') }}" onclick="toggleMobileMenu()"
                    class="block py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider"> About </a>

                <!-- Services (mobile accordion) -->
                <div>
                    <button type="button"
                        class="w-full flex items-center justify-between py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider"
                        aria-expanded="false" aria-controls="mobile-services-list"
                        onclick="toggleMobileServices(this)">
                        Services
                        <i class="fas fa-chevron-down text-sm transition-transform"></i>
                    </button>
                    <div id="mobile-services-list" class="hidden pl-4 space-y-3 pb-2">
                        <a href="{{ route('services.web-development') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">Web Development</a>
                        <a href="{{ route('services.digital-marketing') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">Digital Marketing</a>
                        <a href="{{ route('services.branding') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">Branding & Design</a>
                        <a href="{{ route('services.automation') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">Automation (AI)</a>
                        <a href="{{ route('services.content') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">Content Creation</a>
                        <a href="{{ route('services.solution') }}" onclick="toggleMobileMenu()" class="block text-base font-semibold text-gray-600">IT Solutions</a>
                    </div>
                </div>

                <a href="{{ route('portfolio') }}" onclick="toggleMobileMenu()"
                    class="block py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider">Portfolio</a>
                <a href="{{ route('blog') }}" onclick="toggleMobileMenu()"
                    class="block py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider">Blog</a>
                <a href="{{ route('contact') }}" onclick="toggleMobileMenu()"
                    class="block py-3 text-lg font-bold text-dark hover:text-primary transition-colors uppercase tracking-wider">Contact</a>
            </nav>

           <div class="flex justify-center gap-3 mb-6">
    <button onclick="setLanguage('en')" id="mobile-lang-btn-en"
        class="px-4 py-2 rounded-md border font-semibold transition">
        🇬🇧 EN
    </button>

    <button onclick="setLanguage('fr')" id="mobile-lang-btn-fr"
        class="px-4 py-2 rounded-md border font-semibold transition">
        🇫🇷 FR
    </button>
</div>

            <!-- Mobile Menu Auth Block -->
            <div class="p-6 space-y-4 border-t-2 border-gray-200">
                @guest
                    <a href="{{ route('login') }}"
                        class="w-full h-14 border-2 border-primary text-primary rounded-md font-bold text-sm uppercase tracking-wider flex items-center justify-center transition-all duration-200 hover:bg-primary hover:text-white">
                        Login
                    </a>
                @endguest

                @auth
                    <a href="{{ Auth::user()->role === 'admin' ? route('admin.index') : route('user.dashboard') }}"
                        class="w-full h-14 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider flex items-center justify-center space-x-3 transition-all duration-200">
                        <div
                            class="w-8 h-8 bg-white text-primary font-bold rounded-full flex items-center justify-center text-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span>Go to Dashboard</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>

<script>
    // Header scroll effect
    window.addEventListener('scroll', () => {
        const header = document.getElementById('mainHeader');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('active');
    }

    // Mobile services accordion
    function toggleMobileServices(btn) {
        const list = document.getElementById('mobile-services-list');
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
        list.classList.toggle('hidden');
        btn.querySelector('i').style.transform = expanded ? '' : 'rotate(180deg)';
    }

    // Desktop services dropdown: hover, click and keyboard
    (function () {
        const wrap = document.getElementById('servicesDropdown');
        if (!wrap) return;

        const btn = wrap.querySelector('button');
        const panel = document.getElementById('services-menu');
        const chevron = document.getElementById('servicesChevron');
        let open = false;

        // Focus only moves into the panel when the caller explicitly asks
        // for it (keyboard activation) -- a plain mouse hover must never
        // steal keyboard/screen-reader focus.
        function setOpen(state, opts) {
            opts = opts || {};
            open = state;
            btn.setAttribute('aria-expanded', String(state));
            panel.classList.toggle('opacity-0', !state);
            panel.classList.toggle('invisible', !state);
            panel.classList.toggle('translate-y-1', !state);
            chevron.style.transform = state ? 'rotate(180deg)' : '';
            if (state && opts.focusFirst) panel.querySelector('a').focus();
        }

        // A click MouseEvent synthesized by pressing Enter/Space on a
        // focused <button> has detail === 0 (no real mouse click count),
        // which is how we tell a keyboard activation from a real mouse
        // click here without a separate keydown handler for Enter/Space.
        window.toggleServicesMenu = function (e) {
            const viaKeyboard = !!(e && e.detail === 0);
            setOpen(!open, { focusFirst: viaKeyboard });
        };

        btn.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowDown' && !open) {
                e.preventDefault();
                setOpen(true, { focusFirst: true });
            }
        });

        // Only bind hover open/close on devices whose primary input is an
        // actual mouse (fine pointer + real hover). On touch and hybrid
        // touch-primary devices this stays click-only, so a tap doesn't
        // fire mouseenter/mouseleave and race against the click-outside
        // handler below (the flicker this was causing).
        const supportsHover = window.matchMedia
            && window.matchMedia('(hover: hover) and (pointer: fine)').matches;

        if (supportsHover) {
            wrap.addEventListener('mouseenter', () => setOpen(true, { focusFirst: false }));
            wrap.addEventListener('mouseleave', () => setOpen(false));
        }

        document.addEventListener('keydown', (e) => {
            if (!open) return;
            const items = [...panel.querySelectorAll('a')];
            const i = items.indexOf(document.activeElement);
            if (e.key === 'Escape') { setOpen(false); btn.focus(); }
            if (e.key === 'ArrowDown') { e.preventDefault(); items[(i + 1) % items.length].focus(); }
            if (e.key === 'ArrowUp') { e.preventDefault(); items[(i - 1 + items.length) % items.length].focus(); }
        });

        document.addEventListener('click', (e) => {
            if (open && !wrap.contains(e.target)) setOpen(false);
        });
    })();

    // Active link highlighting
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - 100;
            if (window.pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('text-primary');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('text-primary');
            }
        });
    });
</script>
