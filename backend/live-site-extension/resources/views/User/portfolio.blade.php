@extends('User.main')

@section('title', 'Success Stories & Portfolio - Al-Falah Digital Marketing')

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-primary pt-24 pb-16 md:pt-32 md:pb-20 lg:pt-36 lg:pb-24 overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 md:w-96 md:h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full mb-4 border border-white/10">
            <span class="text-white font-medium text-xs uppercase tracking-widest">Proof of Excellence</span>
        </div>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 tracking-tight leading-tight">
            Real Clients. <span class="text-accent">Real Results.</span>
        </h1>
        <p class="text-sm md:text-base lg:text-lg text-white/80 max-w-2xl mx-auto leading-relaxed">
            From local businesses in the USA to fast-growing startups in Africa, we build digital systems that turn clicks into customers.
        </p>
    </div>
</section>

<!-- PROJECT FILTER -->
<div class="bg-white border-b sticky top-[60px] md:top-[72px] z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex space-x-6 md:space-x-8 overflow-x-auto py-4 md:py-6 no-scrollbar justify-start md:justify-center">
            <button type="button" data-filter="all" class="filter-btn active whitespace-nowrap text-sm uppercase tracking-wider">All Work</button>
            <button type="button" data-filter="Web Design" class="filter-btn whitespace-nowrap text-sm uppercase tracking-wider">Web Design</button>
            <button type="button" data-filter="SEO & Ads" class="filter-btn whitespace-nowrap text-sm uppercase tracking-wider">SEO & Ads</button>
            <button type="button" data-filter="AI Automation" class="filter-btn whitespace-nowrap text-sm uppercase tracking-wider">AI Automation</button>
            <button type="button" data-filter="E-commerce" class="filter-btn whitespace-nowrap text-sm uppercase tracking-wider">E-commerce</button>
        </div>
    </div>
</div>

<!-- PORTFOLIO GRID -->
<section class="py-12 md:py-16 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- 3 Column Layout on Large Screens to keep image sizes small and elegant -->
        <div id="portfolioGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            @forelse($projects as $project)
                <!-- Project Card Items -->
                <div class="project-card group cursor-pointer bg-white rounded-2xl border border-slate-100 p-3 transition-all duration-300 hover:border-slate-200" data-category="{{ $project->category }}" onclick="window.open('{{ $project->project_url ?? '#' }}', '_blank')">

                    <!-- Aspect ratio fixed to 4/3 for crisp and compact image container -->
                    <div class="relative overflow-hidden rounded-xl bg-slate-100 aspect-[4/3]">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <!-- Results Badge Metrics Element -->
                        <div class="absolute top-4 left-4 z-10">
                            <div class="bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-lg border border-slate-100">
                                <p class="text-primary font-bold text-sm tracking-tight">{{ $project->badge_text }}</p>
                            </div>
                        </div>

                        <!-- Hover Overlay Screen -->
                        <div class="absolute inset-0 bg-dark/70 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center p-6">
                            <div class="text-center text-white transform translate-y-3 group-hover:translate-y-0 transition-transform duration-300">
                                <p class="text-xs uppercase tracking-widest font-semibold text-primary mb-1">{{ $project->category }}</p>
                                <h3 class="text-lg font-bold mb-4 line-clamp-2 px-2">{{ $project->title }}</h3>
                                <span class="inline-flex h-10 w-10 items-center justify-center bg-primary text-white rounded-full text-sm">
                                    <i class="fas {{ $project->project_url ? 'fa-external-link-alt' : 'fa-arrow-right' }}"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer Details Inside Border Box -->
                    <div class="mt-4 flex justify-between items-start px-1 pb-1">
                        <div class="min-w-0 flex-1 pr-3">
                            <h4 class="text-base font-bold text-dark truncate">{{ $project->title }}</h4>
                            <p class="text-gray-400 text-xs mt-0.5 truncate">Market: {{ $project->target_market }}</p>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-primary bg-primary/5 px-2.5 py-1 rounded-md shrink-0 border border-primary/10">{{ $project->year }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-1 sm:col-span-2 lg:col-span-3 text-center py-16 text-gray-400">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                        <i class="fas fa-folder-open text-xl text-slate-400"></i>
                    </div>
                    <p class="font-medium text-sm">No projects found in this collection.</p>
                </div>
            @endforelse

        </div>

        <!-- Shown by JS when a filter has zero matching cards -->
        <div id="portfolioEmpty" class="hidden text-center py-16 text-gray-400">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-200">
                <i class="fas fa-folder-open text-xl text-slate-400"></i>
            </div>
            <p class="font-medium text-sm">No projects in this category yet.</p>
        </div>
    </div>
</section>

@if($testimonials->isNotEmpty())
<!-- TESTIMONIAL MINI SECTION -->
<section class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-12 {{ $testimonials->count() > 1 ? 'md:grid-cols-2' : '' }}">
            @foreach($testimonials as $t)
                @php
                    $quote = app()->getLocale() === 'en' && ! empty($t['quote_en']) ? $t['quote_en'] : $t['quote_fr'];
                    $role = app()->getLocale() === 'en' && ! empty($t['author_role_en']) ? $t['author_role_en'] : ($t['author_role_fr'] ?? '');
                    $subtitle = trim($role . (! empty($t['company']) ? ', ' . $t['company'] : ''));
                @endphp
                <div class="text-center">
                    <i class="fas fa-quote-left text-primary/10 text-5xl mb-6"></i>
                    <h2 class="text-xl md:text-2xl font-medium text-dark mb-6 leading-relaxed italic">
                        "{{ $quote }}"
                    </h2>
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-primary/10 text-primary font-bold flex items-center justify-center mb-3 border-2 border-white shadow-sm">
                            {{ strtoupper(substr($t['author_name'], 0, 1)) }}
                        </div>
                        <h5 class="text-dark font-bold text-sm">{{ $t['author_name'] }}</h5>
                        @if($subtitle)
                            <p class="text-gray-400 text-xs mt-0.5">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@section('scripts')
<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    .filter-btn {
        background: transparent;
        border: none;
        padding-bottom: 4px;
        font-weight: 600;
        color: #6b7280; /* gray-500 */
        border-bottom: 2px solid transparent;
        cursor: pointer;
        transition: color 0.2s ease, border-color 0.2s ease;
    }
    .filter-btn:hover {
        color: #2563eb; /* primary */
    }
    .filter-btn.active {
        color: #2563eb; /* primary */
        font-weight: 700;
        border-bottom-color: #2563eb;
    }

    .project-card {
        transition: opacity 0.25s ease, transform 0.25s ease;
    }
    .project-card.is-hidden {
        display: none;
    }
    .project-card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    (function () {
        var filterButtons = document.querySelectorAll('.filter-btn');
        var cards = document.querySelectorAll('.project-card');
        var emptyState = document.getElementById('portfolioEmpty');

        // Trims and lowercases so real-world data drift (e.g. "E-Commerce" vs
        // "E-commerce") can't silently break the filter the way it did before.
        function normalize(value) {
            return (value || '').trim().toLowerCase();
        }

        function applyFilter(category) {
            var visibleCount = 0;
            var normalizedCategory = normalize(category);

            cards.forEach(function (card) {
                var matches = category === 'all' || normalize(card.getAttribute('data-category')) === normalizedCategory;
                if (matches) {
                    card.classList.remove('is-hidden');
                    // Fade in on the next frame so the transition actually plays.
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(6px)';
                    requestAnimationFrame(function () {
                        card.classList.add('is-visible');
                        card.style.opacity = '';
                        card.style.transform = '';
                    });
                    visibleCount++;
                } else {
                    card.classList.remove('is-visible');
                    card.classList.add('is-hidden');
                }
            });

            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount !== 0);
            }
        }

        filterButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                filterButtons.forEach(function (btn) {
                    btn.classList.remove('active');
                });
                button.classList.add('active');
                applyFilter(button.getAttribute('data-filter'));
            });
        });

        // Show every card as visible on first load.
        cards.forEach(function (card) {
            card.classList.add('is-visible');
        });
    })();
</script>
@endsection
