<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leads</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Source</th>
                            <th class="px-6 py-3">Service interest</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Received</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leads as $lead)
                            <tr class="border-t {{ $lead->status === 'needs_verification' ? 'bg-amber-50' : '' }}">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ trim($lead->first_name.' '.$lead->last_name) }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ str($lead->source)->headline() }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $lead->service_interest ?? '—' }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs
                                        @if ($lead->status === 'new') bg-blue-100 text-blue-800
                                        @elseif ($lead->status === 'replied') bg-green-100 text-green-800
                                        @elseif ($lead->status === 'needs_verification') bg-amber-100 text-amber-800
                                        @else bg-gray-100 text-gray-600 @endif">
                                        {{ str($lead->status)->headline() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $lead->created_at->format('M j, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="text-indigo-600">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No leads yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $leads->links() }}</div>
        </div>
    </div>
</x-app-layout>
