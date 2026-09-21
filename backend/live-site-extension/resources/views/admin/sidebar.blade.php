<!-- Sidebar Backdrop (Mobile only) -->
<div x-show="sidebarOpen" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden" x-cloak></div>

<!-- Sidebar -->
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-30 w-64 bg-slate-900 text-white transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0 overflow-y-auto">

    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="text-2xl font-bold tracking-tighter uppercase text-accent">Al-Falah <span
                    class="text-white">Admin</span></span>
        </div>
    </div>

    <nav class="mt-10 px-4 space-y-2 pb-8">
        <a href="{{ route('admin.index') }}"
            class="flex items-center px-4 py-3 text-white rounded-lg transition duration-200">
            <i class="fas fa-th-large w-5"></i>
            <span class="mx-3 font-semibold">Dashboard</span>
        </a>

        <a href="{{ route('admin.users') }}"
            class="flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-envelope w-5"></i>
            <span class="mx-3 font-semibold">Users</span>
        </a>

        <a href="{{ route('admin.blogs.index') }}"
            class="flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-newspaper w-5"></i>
            <span class="mx-3 font-semibold">Blog</span>
        </a>

        <a href="{{ route('admin.content-queue.index') }}"
            class="flex items-center px-4 py-3 {{ Request::routeIs('admin.content-queue.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-robot w-5"></i>
            <span class="mx-3 font-semibold">Content Queue</span>
        </a>

        <a href="{{ route('admin.contacts.index') }}"
            class="flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-briefcase w-5"></i>
            <span class="mx-3 font-semibold">Contact Enquiries</span>
        </a>

        <a href="{{ route('admin.consultations.index') }}"
            class="flex items-center px-4 py-3 text-gray-400 hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-briefcase w-5"></i>
            <span class="mx-3 font-semibold">Meeting Quries</span>
            <span class="ml-auto bg-primary text-white text-xs px-2 py-1 rounded-full">
                {{ \App\Models\Consultation::count() }}
            </span>
        </a>

        <a href="{{ route('admin.orders.index') }}"
            class="flex items-center px-4 py-3 {{ Request::routeIs('admin.orders.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-shopping-cart w-5"></i>
            <span class="mx-3 font-semibold">Orders</span>
            <span class="ml-auto bg-primary text-white text-xs px-2 py-1 rounded-full">
                {{ \App\Models\Order::count() }}
            </span>
        </a>

        <a href="{{ route('admin.domains.index') }}"
            class="flex items-center px-4 py-3 {{ Request::routeIs('admin.domains.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-globe w-5"></i>
            <span class="mx-3 font-semibold">Domain Details</span>
            <span class="ml-auto bg-blue-600 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-md">
                {{ \App\Models\DomainDetail::count() }}
            </span>
        </a>

        <!-- Newsletter Section -->
        <a href="{{ route('admin.newsletter.index') }}"
            class="flex items-center px-4 py-3 {{ Request::routeIs('admin.newsletter.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
            <i class="fas fa-newspaper w-5"></i>
            <span class="mx-3 font-semibold">Newsletter</span>
            <span class="ml-auto bg-purple-600 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-md">
                {{ \App\Models\NewsletterSubscriber::count() }}
            </span>
        </a>

        <div class="pt-4 mt-4 border-t border-slate-700 space-y-2">

            <a href="{{ route('admin.services.index') }}"
                class="flex items-center px-4 py-3 {{ Request::routeIs('admin.services.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
                <i class="fas fa-tags w-5"></i>
                <span class="mx-3 font-semibold">Services &amp; Tarifs</span>
                <span class="ml-auto bg-emerald-600 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-md">
                    {{ \App\Support\ContentStore::for('services')->count() }}
                </span>
            </a>

            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center px-4 py-3 {{ Request::routeIs('admin.testimonials.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
                <i class="fas fa-quote-left w-5"></i>
                <span class="mx-3 font-semibold">Témoignages</span>
                <span class="ml-auto bg-amber-600 text-white text-[11px] font-bold px-2.5 py-0.5 rounded-full shadow-md">
                    {{ \App\Support\ContentStore::for('testimonials')->count() }}
                </span>
            </a>

            <a href="{{ route('admin.portfolio.index') }}"
                class="flex items-center px-4 py-3 {{ Request::routeIs('admin.portfolio.*') ? 'bg-slate-800 text-white' : 'text-gray-400' }} hover:bg-slate-800 hover:text-white rounded-lg transition duration-200">
                <i class="fas fa-cog w-5"></i>
                <span class="mx-3 font-semibold">Portfolio</span>
            </a>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center px-4 py-3 text-red-400 hover:bg-red-500 hover:text-white rounded-lg transition duration-200">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="mx-3 font-semibold">Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>
</div>
