@extends('User.main')

@section('title', 'Insights & Blog - Al-Falah Digital Marketing')

@section('main-section')

<!-- HERO SECTION -->
<section class="relative bg-primary pt-24 pb-16 md:pt-32 md:pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
    <div class="absolute top-0 right-0 w-64 h-64 md:w-96 md:h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-block px-4 py-2 bg-white/20 rounded-md mb-4 md:mb-6">
            <span class="text-white font-semibold text-xs md:text-sm uppercase tracking-wider">Al-Falah Insights</span>
        </div>
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-4 md:mb-6 tracking-tighter leading-tight">
            Knowledge for <span class="text-accent">Growth</span>
        </h1>
        <p class="text-base md:text-lg lg:text-xl text-white/90 max-w-2xl mx-auto leading-relaxed px-2">
            Expert advice on SEO, AI-Marketing, and Web Design tailored for small businesses in the USA and Africa.
        </p>

        <!-- Search Bar -->
        <div class="mt-8 md:mt-10 max-w-xl mx-auto px-2">
            <form action="{{ route('blog') }}" method="GET" class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for topics..." class="w-full h-14 md:h-16 pl-6 pr-16 rounded-full bg-white text-dark focus:outline-none shadow-xl text-sm md:text-base">
                <button type="submit" class="absolute right-1.5 top-1.5 h-11 w-11 md:h-13 md:w-13 bg-primary text-white rounded-full hover:bg-blue-700 transition-all flex items-center justify-center">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- CATEGORY FILTER (Responsive Sticky Pill Bar) -->
@php
    $categoryTabs = [
        ['label' => 'All Posts', 'value' => null],
        ['label' => 'Web Design', 'value' => 'Web Design'],
        ['label' => 'SEO Tips', 'value' => 'SEO Tips'],
        ['label' => 'AI in Marketing', 'value' => 'AI Marketing'],
    ];
    $totalPosts = $categoryCounts->sum();
@endphp
<div class="bg-white/95 backdrop-blur border-b border-gray-100 shadow-sm sticky top-[60px] md:top-[72px] z-20">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Filter blog posts by category">
        <div id="categoryFilterBar" class="flex items-center gap-2 md:gap-3 overflow-x-auto py-3 md:py-4 no-scrollbar">
            @foreach ($categoryTabs as $tab)
                @php
                    $isActive = $category === $tab['value'];
                    $count = $tab['value'] ? ($categoryCounts[$tab['value']] ?? 0) : $totalPosts;
                @endphp
                <a
                    href="{{ route('blog', $tab['value'] ? ['category' => $tab['value']] : []) }}"
                    class="category-pill inline-flex items-center gap-2 whitespace-nowrap rounded-full border px-4 py-2 md:px-5 md:py-2.5 text-xs md:text-sm font-bold uppercase tracking-wide transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2
                        {{ $isActive
                            ? 'bg-primary border-primary text-white shadow-sm'
                            : 'bg-muted border-transparent text-gray-600 hover:bg-primary/10 hover:text-primary' }}"
                    @if ($isActive) aria-current="page" @endif
                >
                    {{ $tab['label'] }}
                    <span class="rounded-full px-1.5 py-0.5 text-[10px] md:text-xs font-semibold
                        {{ $isActive ? 'bg-white/20 text-white' : 'bg-white text-gray-500' }}">
                        {{ $count }}
                    </span>
                </a>
            @endforeach
        </div>
    </nav>
</div>

<!-- DYNAMIC FEATURED POST -->
@if($featured && !$category && !$search)
<section class="py-10 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="group relative bg-muted rounded-2xl md:rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="relative h-64 sm:h-80 lg:h-full overflow-hidden">
                    <img src="{{ asset('storage/public/' . $featured->image) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                </div>
                <div class="p-6 md:p-10 lg:p-16 flex flex-col justify-center">
                    <div class="flex items-center space-x-4 mb-4 md:mb-6">
                        <span class="px-2.5 py-1 bg-accent/20 text-accent text-[10px] md:text-xs font-bold uppercase rounded">Featured</span>
                        <span class="text-gray-500 text-xs md:text-sm">{{ $featured->created_at->format('M d, Y') }}</span>
                    </div>
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-dark mb-4 md:mb-6 leading-tight group-hover:text-primary transition-colors">
                        {{ $featured->title }}
                    </h2>
                    <p class="text-gray-600 text-sm md:text-base lg:text-lg mb-6 md:mb-8">
                        {{ Str::limit(strip_tags($featured->content), 160) }}
                    </p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-xs md:text-sm">AJ</div>
                            <span class="text-dark font-bold text-xs md:text-sm">Abdulrahman Jalloh</span>
                        </div>
                        <!-- FIXED: Use slug instead of id -->
                        <a href="{{ route('blog.show', $featured->slug) }}" class="text-primary font-bold inline-flex items-center text-xs md:text-sm">
                            Read Article <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- MAIN BLOG GRID -->
<section class="py-8 md:py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($blogs->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">
                    @if ($search && $category)
                        No posts matching "{{ $search }}" in "{{ $category }}".
                    @elseif ($search)
                        No posts matching "{{ $search }}".
                    @elseif ($category)
                        No posts in "{{ $category }}" yet.
                    @else
                        No blog posts found.
                    @endif
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($blogs as $blog)
                <article class="flex flex-col group h-full">
                    <div class="relative rounded-2xl overflow-hidden mb-6 aspect-[16/10]">
                        <img src="{{ asset('storage/public/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="flex items-center space-x-3 mb-3 text-xs text-gray-500">
                        <span class="px-2.5 py-1 bg-gray-100 text-gray-800 font-bold uppercase rounded text-[10px]">
                            {{ $blog->category ?? 'General' }}
                        </span>
                        <span>•</span>
                        <span>{{ $blog->read_time ?? '3 Min Read' }}</span>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold mb-4 line-clamp-2 text-dark group-hover:text-primary transition-colors h-[3.5rem]">
                        {{ $blog->title }}
                    </h3>
                    <p class="text-gray-600 mb-6 line-clamp-3">
                        {{ Str::limit(strip_tags($blog->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400">{{ $blog->created_at->format('M d, Y') }}</span>
                        <!-- FIXED: Use slug instead of id -->
                        <a href="{{ route('blog.show', $blog->slug) }}" class="text-primary font-bold inline-flex items-center text-xs md:text-sm">
                            Read More <i class="fas fa-arrow-right ml-2 text-[10px]"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination Links -->
            @if(method_exists($blogs, 'links'))
                <div class="mt-12">
                    {{ $blogs->links() }}
                </div>
            @endif
        @endif
    </div>
</section>

<!-- NEWSLETTER SECTION -->
<section class="py-12 md:py-20 bg-muted">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-primary rounded-3xl md:rounded-[3rem] p-8 md:p-12 lg:p-20 relative overflow-hidden">
            <!-- Decor -->
            <div class="absolute top-0 right-0 w-48 h-48 md:w-64 md:h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>

            <div class="relative z-10 text-center">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-4 md:mb-6">Stay Ahead of the Curve</h2>
                <p class="text-white/80 text-sm md:text-lg mb-8 md:mb-10 max-w-xl mx-auto px-2">
                    Get the latest marketing strategies for USA & Africa delivered straight to your inbox once a month.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row gap-3 md:gap-4 max-w-lg mx-auto">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" class="flex-1 h-14 md:h-16 px-6 rounded-full bg-white focus:outline-none text-sm" required>
                    <button type="submit" class="h-14 md:h-16 px-8 md:px-10 bg-accent text-white font-bold rounded-full uppercase tracking-wider hover:scale-105 transition-all text-xs md:text-sm">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<style>
    /* Hide scrollbar for category filter while allowing touch scroll */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    // Roving keyboard navigation between the category pills: Left/Right
    // (and Home/End) move focus without changing pages -- Enter/Space on
    // the focused pill follows its link natively, since these are real
    // navigating <a> elements rather than JS-only tab panels.
    (function () {
        const bar = document.getElementById('categoryFilterBar');
        if (!bar) return;

        const pills = [...bar.querySelectorAll('.category-pill')];

        bar.addEventListener('keydown', (e) => {
            const i = pills.indexOf(document.activeElement);
            if (i === -1) return;

            let next = null;
            if (e.key === 'ArrowRight') next = pills[(i + 1) % pills.length];
            if (e.key === 'ArrowLeft') next = pills[(i - 1 + pills.length) % pills.length];
            if (e.key === 'Home') next = pills[0];
            if (e.key === 'End') next = pills[pills.length - 1];

            if (next) {
                e.preventDefault();
                next.focus();
                next.scrollIntoView({ block: 'nearest', inline: 'nearest' });
            }
        });
    })();
</script>
@endsection
