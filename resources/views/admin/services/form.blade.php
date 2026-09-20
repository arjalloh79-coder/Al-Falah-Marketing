@extends('admin.main')

@php
    $editing = $service !== null;
    $val = function ($key, $default = '') use ($service) {
        return old($key, $service[$key] ?? $default);
    };
@endphp

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-white">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.services.index') }}" class="text-gray-400 hover:text-white">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-bold">
            {{ $editing ? 'Modifier le service' : 'Ajouter un service' }}
        </h2>
    </div>

    @if($errors->any())
        <div class="bg-red-600 text-white p-4 rounded-lg mb-4">
            <p class="font-semibold mb-2">Veuillez corriger les points suivants :</p>
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ $editing ? route('admin.services.update', $service['id']) : route('admin.services.store') }}"
          method="POST" class="bg-slate-800 rounded-xl p-6 space-y-6 max-w-4xl">
        @csrf
        @if($editing)
            @method('PUT')
        @endif

        {{-- Category --}}
        <div>
            <label class="block text-sm font-semibold mb-2">Catégorie <span class="text-red-400">*</span></label>
            <input type="text" name="category" list="category-list" required
                   value="{{ $val('category') }}"
                   class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            <datalist id="category-list">
                @foreach($categories as $c)
                    <option value="{{ $c }}"></option>
                @endforeach
            </datalist>
            <p class="text-xs text-gray-500 mt-1">Choisissez une catégorie existante ou tapez-en une nouvelle.</p>
        </div>

        {{-- Names --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Nom (français) <span class="text-red-400">*</span></label>
                <input type="text" name="name_fr" required value="{{ $val('name_fr') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Name (English)</label>
                <input type="text" name="name_en" value="{{ $val('name_en') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        {{-- Descriptions --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Description (français)</label>
                <textarea name="description_fr" rows="3"
                          class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">{{ $val('description_fr') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Description (English)</label>
                <textarea name="description_en" rows="3"
                          class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">{{ $val('description_en') }}</textarea>
            </div>
        </div>

        {{-- Price block --}}
        <div class="grid md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Prix <span class="text-red-400">*</span></label>
                <input type="number" name="price" required min="0" step="1000" value="{{ $val('price', 0) }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Chiffres uniquement, sans espaces.</p>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Devise <span class="text-red-400">*</span></label>
                <select name="currency" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
                    @foreach(['FCFA', 'GNF', 'USD', 'EUR'] as $cur)
                        <option value="{{ $cur }}" @selected($val('currency', 'FCFA') === $cur)>{{ $cur }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Facturation <span class="text-red-400">*</span></label>
                <select name="period" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
                    <option value="once"  @selected($val('period', 'once') === 'once')>Une fois / One-off</option>
                    <option value="month" @selected($val('period', 'once') === 'month')>Par mois / Monthly</option>
                    <option value="year"  @selected($val('period', 'once') === 'year')>Par an / Yearly</option>
                </select>
            </div>
        </div>

        {{-- Duration --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Durée (français)</label>
                <input type="text" name="duration_fr" value="{{ $val('duration_fr') }}" placeholder="ex : 10 jours"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Duration (English)</label>
                <input type="text" name="duration_en" value="{{ $val('duration_en') }}" placeholder="e.g. 10 days"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        {{-- Notes --}}
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Observation (français)</label>
                <input type="text" name="note_fr" value="{{ $val('note_fr') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Note (English)</label>
                <input type="text" name="note_en" value="{{ $val('note_en') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        {{-- Visibility + order --}}
        <div class="grid md:grid-cols-2 gap-4 items-start">
            <div>
                <label class="block text-sm font-semibold mb-2">Ordre d'affichage</label>
                <input type="number" name="sort_order" min="0" value="{{ $val('sort_order', 0) }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Le plus petit nombre apparaît en premier.</p>
            </div>
            <div class="pt-8">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           @checked(filter_var($val('is_active', true), FILTER_VALIDATE_BOOLEAN))
                           class="w-5 h-5 rounded bg-slate-900 border-slate-700">

                    <span class="text-sm font-semibold">Afficher ce service sur le site</span>
                </label>
                <p class="text-xs text-gray-500 mt-1 ml-8">Décochez pour le garder sans le publier.</p>
            </div>
        </div>

        <div class="flex gap-3 pt-2 border-t border-slate-700">
            <button type="submit" class="bg-blue-600 px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition mt-4">
                <i class="fas fa-save mr-2"></i>{{ $editing ? 'Enregistrer' : 'Ajouter' }}
            </button>
            <a href="{{ route('admin.services.index') }}"
               class="bg-slate-700 px-6 py-2.5 rounded-lg font-semibold hover:bg-slate-600 transition mt-4">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
