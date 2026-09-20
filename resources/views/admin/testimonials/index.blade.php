@extends('admin.main')

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-white">

    <div class="flex flex-wrap gap-4 justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Témoignages clients</h2>
            <p class="text-sm text-gray-400 mt-1">
                {{ $total }} témoignage{{ $total > 1 ? 's' : '' }} &middot;
                {{ $activeCount }} publié{{ $activeCount > 1 ? 's' : '' }}
                <span class="text-gray-600">|</span>
                <span class="text-gray-500">Client testimonials — {{ $activeCount }} of {{ $total }} published</span>
            </p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}"
           class="bg-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Ajouter un témoignage
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    @forelse($testimonials as $t)
        <div class="bg-slate-800 rounded-xl p-5 mb-4 {{ empty($t['is_active']) ? 'opacity-60' : '' }}">
            <div class="flex flex-wrap gap-4 justify-between items-start">
                <div class="flex items-start gap-4 flex-1 min-w-[260px]">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-blue-600/20 border border-blue-600/40 flex items-center justify-center font-bold text-blue-300">
                        {{ strtoupper(mb_substr($t['author_name'] ?? '?', 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="font-bold">{{ $t['author_name'] ?? '—' }}</span>
                            <span class="text-amber-400 text-sm">
                                @for($i = 0; $i < (int) ($t['rating'] ?? 5); $i++)<i class="fas fa-star"></i>@endfor
                            </span>
                        </div>
                        @if(!empty($t['author_role_fr']) || !empty($t['company']))
                            <div class="text-xs text-gray-400 mt-0.5">
                                {{ $t['author_role_fr'] ?? '' }}@if(!empty($t['company'])), {{ $t['company'] }}@endif
                            </div>
                        @endif
                        <blockquote class="text-sm text-gray-300 mt-3 border-l-2 border-slate-600 pl-3 italic">
                            {{ $t['quote_fr'] ?? '' }}
                        </blockquote>
                        @if(!empty($t['quote_en']))
                            <blockquote class="text-sm text-gray-500 mt-2 border-l-2 border-slate-700 pl-3 italic">
                                {{ $t['quote_en'] }}
                            </blockquote>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <form action="{{ route('admin.testimonials.toggle', $t['id']) }}" method="POST">
                        @csrf
                        @if(!empty($t['is_active']))
                            <button type="submit" title="Cliquer pour masquer"
                                    class="bg-green-600/20 text-green-400 border border-green-600/40 px-3 py-1 rounded-full text-xs font-semibold hover:bg-green-600/30">
                                <i class="fas fa-eye mr-1"></i>Publié
                            </button>
                        @else
                            <button type="submit" title="Cliquer pour publier"
                                    class="bg-slate-700 text-gray-400 border border-slate-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-slate-600">
                                <i class="fas fa-eye-slash mr-1"></i>Brouillon
                            </button>
                        @endif
                    </form>

                    <a href="{{ route('admin.testimonials.edit', $t['id']) }}"
                       class="text-blue-400 hover:text-blue-300" title="Modifier"><i class="fas fa-pen"></i></a>

                    <form action="{{ route('admin.testimonials.destroy', $t['id']) }}" method="POST"
                          onsubmit="return confirm('Supprimer le témoignage de {{ $t['author_name'] ?? '' }} ?\n\nPermanently delete this testimonial?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:text-red-400" title="Supprimer"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-slate-800 rounded-xl p-12 text-center">
            <i class="fas fa-quote-left text-4xl text-slate-600 mb-4"></i>
            <p class="text-gray-400 mb-1">Aucun témoignage pour le moment.</p>
            <p class="text-sm text-gray-500 mb-6">
                No testimonials yet — the section stays hidden on the site until you publish one.
            </p>
            <a href="{{ route('admin.testimonials.create') }}"
               class="bg-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition inline-block">
                <i class="fas fa-plus mr-2"></i>Ajouter le premier témoignage
            </a>
        </div>
    @endforelse

</div>
@endsection
