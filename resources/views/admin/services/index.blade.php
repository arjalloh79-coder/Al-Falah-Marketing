@extends('admin.main')

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-white">

    <div class="flex flex-wrap gap-4 justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold">Services &amp; Tarifs</h2>
            <p class="text-sm text-gray-400 mt-1">
                {{ $total }} service{{ $total > 1 ? 's' : '' }} &middot;
                {{ $activeCount }} affiché{{ $activeCount > 1 ? 's' : '' }} sur le site
                <span class="text-gray-600">|</span>
                <span class="text-gray-500">Services &amp; pricing — {{ $activeCount }} of {{ $total }} shown on the site</span>
            </p>
        </div>
        <a href="{{ route('admin.services.create') }}"
           class="bg-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>Ajouter un service
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white p-4 rounded-lg mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-600 text-white p-4 rounded-lg mb-4">{{ session('error') }}</div>
    @endif

    @forelse($groups as $category => $services)
        <div class="mb-8">
            <h3 class="text-lg font-bold text-blue-400 mb-3 flex items-center">
                <i class="fas fa-folder-open mr-2 text-sm"></i>{{ $category }}
                <span class="ml-3 text-xs font-normal text-gray-500">{{ count($services) }} service{{ count($services) > 1 ? 's' : '' }}</span>
            </h3>

            <div class="bg-slate-800 rounded-xl overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[760px]">
                    <thead>
                        <tr class="bg-slate-700 text-gray-300 text-xs uppercase">
                            <th class="p-4">Service</th>
                            <th class="p-4">Durée</th>
                            <th class="p-4 text-right">Prix</th>
                            <th class="p-4 text-center">Sur le site</th>
                            <th class="p-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        @foreach($services as $s)
                        <tr class="{{ empty($s['is_active']) ? 'opacity-50' : '' }}">
                            <td class="p-4">
                                <div class="font-semibold">{{ $s['name_fr'] ?? '—' }}</div>
                                @if(!empty($s['name_en']))
                                    <div class="text-xs text-gray-500">{{ $s['name_en'] }}</div>
                                @endif
                                @if(!empty($s['description_fr']))
                                    <div class="text-sm text-gray-400 mt-1">{{ $s['description_fr'] }}</div>
                                @endif
                                @if(!empty($s['note_fr']))
                                    <div class="text-xs text-amber-400/80 mt-1"><i class="fas fa-circle-info mr-1"></i>{{ $s['note_fr'] }}</div>
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-400 whitespace-nowrap">{{ $s['duration_fr'] ?? '—' }}</td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <span class="font-bold text-base">{{ number_format($s['price'] ?? 0, 0, ',', ' ') }}</span>
                                <span class="text-xs text-gray-400">{{ $s['currency'] ?? 'FCFA' }}</span>
                                @if(($s['period'] ?? 'once') === 'month')
                                    <div class="text-xs text-gray-500">par mois</div>
                                @elseif(($s['period'] ?? 'once') === 'year')
                                    <div class="text-xs text-gray-500">par an</div>
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                <form action="{{ route('admin.services.toggle', $s['id']) }}" method="POST">
                                    @csrf
                                    @if(!empty($s['is_active']))
                                        <button type="submit" title="Cliquer pour masquer"
                                                class="bg-green-600/20 text-green-400 border border-green-600/40 px-3 py-1 rounded-full text-xs font-semibold hover:bg-green-600/30">
                                            <i class="fas fa-eye mr-1"></i>Visible
                                        </button>
                                    @else
                                        <button type="submit" title="Cliquer pour afficher"
                                                class="bg-slate-700 text-gray-400 border border-slate-600 px-3 py-1 rounded-full text-xs font-semibold hover:bg-slate-600">
                                            <i class="fas fa-eye-slash mr-1"></i>Masqué
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.services.edit', $s['id']) }}"
                                       class="text-blue-400 hover:text-blue-300" title="Modifier">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.services.destroy', $s['id']) }}" method="POST"
                                          onsubmit="return confirm('Supprimer définitivement « {{ $s['name_fr'] ?? '' }} » ?\n\nPermanently delete this service?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-400" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="bg-slate-800 rounded-xl p-12 text-center">
            <i class="fas fa-tags text-4xl text-slate-600 mb-4"></i>
            <p class="text-gray-400 mb-1">Aucun service pour le moment.</p>
            <p class="text-sm text-gray-500 mb-6">No services yet.</p>
            <a href="{{ route('admin.services.create') }}"
               class="bg-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition inline-block">
                <i class="fas fa-plus mr-2"></i>Ajouter le premier service
            </a>
        </div>
    @endforelse

</div>
@endsection
