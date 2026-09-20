@extends('admin.main')

@section('admin-content')

<!-- Page Heading -->
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-slate-800">Welcome Back, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-500">Here's what is happening with Al-Falah Marketing today.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase">Total Leads</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($stats['total_leads']) }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>
        <p class="text-gray-400 text-xs font-bold mt-4">Contact enquiries + consultation requests</p>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase">Blog Posts</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($stats['blog_posts']) }}</h3>
            </div>
            <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
        </div>
        <p class="text-gray-400 text-xs font-bold mt-4">Published articles</p>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase">Portfolio Items</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($stats['active_projects']) }}</h3>
            </div>
            <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-tasks text-xl"></i>
            </div>
        </div>
        <p class="text-gray-400 text-xs font-bold mt-4">Showcased projects</p>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold text-gray-500 uppercase">New Contacts (7d)</p>
                <h3 class="text-3xl font-bold text-slate-800 mt-1">{{ number_format($stats['new_contacts_week']) }}</h3>
            </div>
            <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-clock text-xl"></i>
            </div>
        </div>
        <p class="text-rose-500 text-xs font-bold mt-4">From the last 7 days</p>
    </div>
</div>

<!-- Recent Inquiries Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-slate-800 text-lg">Recent Inquiries</h3>
        <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 text-sm font-bold hover:underline">View All</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-widest font-bold">
                    <th class="px-6 py-4">Client Name</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Service Interest</th>
                    <th class="px-6 py-4">Received</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($recentContacts as $contact)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-semibold text-sm text-slate-700">{{ $contact->first_name }} {{ $contact->last_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->email }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->service_interest ?? '—' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $contact->created_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">No contact enquiries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
