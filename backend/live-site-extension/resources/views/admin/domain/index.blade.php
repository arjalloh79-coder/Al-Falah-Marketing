@extends('admin.main')

@section('admin-content')
<div class="p-6 bg-slate-900 min-h-screen text-gray-100">
    <!-- Header Area -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight">Domain Details Tracker</h1>
            <p class="text-slate-400 mt-1 text-sm">Monitor registration cycles, renewals, and client domain ownership.</p>
        </div>
        <button onclick="toggleModal('addDomainModal')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-5 py-2.5 rounded-lg transition duration-200 shadow-lg shadow-blue-950 flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Domain
        </button>
    </div>

    <!-- Feedback Alerts -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg flex items-center gap-3">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-lg">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-slate-800 rounded-xl border border-slate-700/50 shadow-2xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-750 border-b border-slate-700 text-slate-300 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Client Info</th>
                        <th class="px-6 py-4">Domain Name</th>
                        <th class="px-6 py-4">Registration Window</th>
                        <th class="px-6 py-4">Time Remaining / Status</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/50">
                    @forelse($domains as $item)
                        @php
                            $today = \Carbon\Carbon::today();
                            $expiry = \Carbon\Carbon::parse($item->end_date);
                            $daysRemaining = $today->diffInDays($expiry, false);
                        @endphp
                        <tr class="hover:bg-slate-750/40 transition duration-150">
                            <!-- Client Details -->
                            <td class="px-6 py-4">
                                <div class="font-semibold text-white">{{ $item->user->name }}</div>
                                <div class="text-xs text-slate-400 mt-0.5">{{ $item->user->email }}</div>
                            </td>
                            
                            <!-- Domain Name -->
                            <td class="px-6 py-4 font-mono font-medium text-blue-400">
                                <a href="http://{{ $item->domain_name }}" target="_blank" class="hover:underline flex items-center gap-1.5">
                                    {{ $item->domain_name }}
                                    <i class="fas fa-external-link-alt text-[10px] opacity-50"></i>
                                </a>
                            </td>
                            
                            <!-- Start & End Date -->
                            <td class="px-6 py-4 text-sm text-slate-300">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs px-2 py-0.5 rounded bg-slate-700 text-slate-400">Start</span>
                                    <span>{{ date('M d, Y', strtotime($item->start_date)) }}</span>
                                </div>
                                <div class="flex items-center gap-2 mt-1.5">
                                    <span class="text-xs px-2 py-0.5 rounded bg-slate-700 text-slate-400">Expiry</span>
                                    <span>{{ date('M d, Y', strtotime($item->end_date)) }}</span>
                                </div>
                            </td>

                            <!-- Dynamic Status Badges -->
                            <td class="px-6 py-4 text-sm">
                                @if($daysRemaining < 0)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-500/10 border border-rose-500/20 text-rose-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Expired
                                    </span>
                                @elseif($daysRemaining <= 30)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 border border-amber-500/20 text-amber-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Expiring in {{ $daysRemaining }} days
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Active ({{ $daysRemaining }} Days Left)
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.domains.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete tracking for this domain?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-rose-400 p-2 rounded-lg hover:bg-rose-500/10 transition duration-150" title="Delete Domain Details">
                                        <i class="far fa-trash-alt text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                <div class="text-3xl mb-3"><i class="fas fa-globe"></i></div>
                                <p class="text-sm">No domains added yet. Click "Add New Domain" to start tracking.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Creation Modal Setup -->
<div id="addDomainModal" class="fixed inset-0 z-50 overflow-y-auto hidden">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/70 backdrop-blur-sm transition-opacity" onclick="toggleModal('addDomainModal')"></div>

    <!-- Modal Content Panel -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative w-full max-w-lg rounded-2xl bg-slate-800 border border-slate-700 text-gray-100 p-6 shadow-2xl transition-all">
            <!-- Header -->
            <div class="flex items-center justify-between pb-4 border-b border-slate-700">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-globe text-blue-500"></i> Track New Domain
                </h3>
                <button onclick="toggleModal('addDomainModal')" class="text-slate-400 hover:text-white p-1 rounded-lg transition">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.domains.store') }}" method="POST" class="mt-6 space-y-5">
                @csrf
                
                <!-- Client Selection -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-semibold text-slate-400 mb-2">Assign to Client User</label>
                    <select name="user_id" required class="w-full h-12 bg-slate-900 border border-slate-700 rounded-lg px-3 text-sm text-gray-100 outline-none focus:border-blue-500 transition duration-150">
                        <option value="" disabled selected>Select a client from database...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Domain Input -->
                <div>
                    <label class="block text-xs uppercase tracking-wider font-semibold text-slate-400 mb-2">Domain URL Name</label>
                    <input type="text" name="domain_name" placeholder="example.com" required
                        class="w-full h-12 bg-slate-900 border border-slate-700 rounded-lg px-3 text-sm text-gray-100 outline-none focus:border-blue-500 transition duration-150 font-mono">
                </div>

                <!-- Dates Grid -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-semibold text-slate-400 mb-2">Start Date</label>
                        <input type="date" name="start_date" required
                            class="w-full h-12 bg-slate-900 border border-slate-700 rounded-lg px-3 text-sm text-gray-100 outline-none focus:border-blue-500 transition duration-150">
                    </div>
                    <div>
                        <label class="block text-xs uppercase tracking-wider font-semibold text-slate-400 mb-2">End Date (Expiry)</label>
                        <input type="date" name="end_date" required
                            class="w-full h-12 bg-slate-900 border border-slate-700 rounded-lg px-3 text-sm text-gray-100 outline-none focus:border-blue-500 transition duration-150 font-medium text-blue-400">
                    </div>
                </div>

                <!-- Action Button -->
                <div class="flex justify-end gap-3 pt-4 border-t border-slate-700/50 mt-6">
                    <button type="button" onclick="toggleModal('addDomainModal')" class="px-5 py-2.5 bg-slate-700 hover:bg-slate-650 rounded-lg font-medium text-sm transition duration-150">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition duration-150">
                        Register Domain
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }
</script>
@endsection