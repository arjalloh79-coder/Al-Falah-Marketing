@extends('admin.main')

@section('admin-content')

<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold text-slate-800">
        Search Results
    </h1>
    <p class="text-gray-500 mt-2">
        @if ($query !== '')
            Showing matches for "<span class="font-semibold text-slate-700">{{ $query }}</span>"
        @else
            Enter a search term above to find users, blog posts, contact enquiries, consultations, orders, portfolio items, newsletter subscribers, or domains.
        @endif
    </p>
</div>

@if ($query !== '' && empty($results))
    <div class="bg-white p-10 rounded-2xl shadow-sm border text-center">
        <i class="fas fa-search text-gray-300 text-3xl mb-4"></i>
        <p class="text-slate-800 font-bold">No matches found</p>
        <p class="text-gray-500 text-sm mt-1">Try a different name, email, or keyword.</p>
    </div>
@endif

@foreach ($results as $section => $data)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
        <div class="flex items-center justify-between px-6 py-4 bg-slate-50 border-b border-gray-100">
            <h2 class="text-sm font-black uppercase tracking-wider text-slate-600">{{ $section }}</h2>
            <a href="{{ route($data['route']) }}" class="text-xs font-bold text-primary hover:underline">View all</a>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach ($data['items'] as $item)
                <a href="{{ $item['url'] }}" class="flex items-center justify-between px-6 py-4 hover:bg-slate-50/50 transition-colors">
                    <div>
                        <p class="font-bold text-slate-800 text-sm">{{ $item['title'] }}</p>
                        @if ($item['subtitle'])
                            <p class="text-xs text-gray-500 mt-0.5">{{ $item['subtitle'] }}</p>
                        @endif
                    </div>
                    <i class="fas fa-chevron-right text-gray-300 text-xs"></i>
                </a>
            @endforeach
        </div>
    </div>
@endforeach

@endsection
