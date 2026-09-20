@extends('admin.main')

@php
    $editing = $testimonial !== null;
    $val = function ($key, $default = '') use ($testimonial) {
        return old($key, $testimonial[$key] ?? $default);
    };
@endphp

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-white">

    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-white">
            <i class="fas fa-arrow-left"></i>
        </a>
        <h2 class="text-2xl font-bold">
            {{ $editing ? 'Modifier le témoignage' : 'Ajouter un témoignage' }}
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

    <form action="{{ $editing ? route('admin.testimonials.update', $testimonial['id']) : route('admin.testimonials.store') }}"
          method="POST" class="bg-slate-800 rounded-xl p-6 space-y-6 max-w-4xl">
        @csrf
        @if($editing)
            @method('PUT')
        @endif

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Nom du client <span class="text-red-400">*</span></label>
                <input type="text" name="author_name" required value="{{ $val('author_name') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Entreprise</label>
                <input type="text" name="company" value="{{ $val('company') }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-2">Fonction (français)</label>
                <input type="text" name="author_role_fr" value="{{ $val('author_role_fr') }}" placeholder="ex : Directrice générale"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Role (English)</label>
                <input type="text" name="author_role_en" value="{{ $val('author_role_en') }}" placeholder="e.g. Managing Director"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Témoignage (français) <span class="text-red-400">*</span></label>
            <textarea name="quote_fr" rows="4" required
                      class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">{{ $val('quote_fr') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Les mots exacts du client. N'inventez rien — un faux avis se repère et coûte la confiance.</p>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Testimonial (English)</label>
            <textarea name="quote_en" rows="4"
                      class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">{{ $val('quote_en') }}</textarea>
            <p class="text-xs text-gray-500 mt-1">Traduction du témoignage ci-dessus. Laissez vide si vous n'en avez pas.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-4 items-start">
            <div>
                <label class="block text-sm font-semibold mb-2">Note <span class="text-red-400">*</span></label>
                <select name="rating" required
                        class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" @selected((int) $val('rating', 5) === $i)>
                            {{ str_repeat('★', $i) }} ({{ $i }}/5)
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-2">Ordre d'affichage</label>
                <input type="number" name="sort_order" min="0" value="{{ $val('sort_order', 0) }}"
                       class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-2.5 focus:outline-none focus:border-blue-500">
            </div>
            <div class="pt-8">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           @checked(filter_var($val('is_active', false), FILTER_VALIDATE_BOOLEAN))
                           class="w-5 h-5 rounded bg-slate-900 border-slate-700">
                    <span class="text-sm font-semibold">Publier sur le site</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-2 border-t border-slate-700">
            <button type="submit" class="bg-blue-600 px-6 py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition mt-4">
                <i class="fas fa-save mr-2"></i>{{ $editing ? 'Enregistrer' : 'Ajouter' }}
            </button>
            <a href="{{ route('admin.testimonials.index') }}"
               class="bg-slate-700 px-6 py-2.5 rounded-lg font-semibold hover:bg-slate-600 transition mt-4">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection
