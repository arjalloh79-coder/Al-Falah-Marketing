@extends('admin.main')

@section('admin-content')
<div class="max-w-6xl mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Contact Enquiries</h1>
            <p class="text-sm text-gray-500">View and manage messages sent by website visitors.</p>
        </div>
    </div>

    <!-- Success Message Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-lg shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="bg-white rounded-2xl shadow-sm border overflow-hidden">
        @if($contacts->isEmpty())
            <!-- Empty State -->
            <div class="p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0V9a2 2 0 00-2-2H6a2 2 0 00-2 2v4.5m12+3.5h-12" />
                </svg>
                <h3 class="text-lg font-bold text-gray-700 mb-1">No enquiries found</h3>
                <p class="text-gray-500">When users submit the contact form, their queries will appear here.</p>
            </div>
        @else
            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b text-gray-500 text-xs font-bold uppercase tracking-wider">
                            <th class="p-4 pl-6">Sender Details</th>
                            <th class="p-4">Service Interest</th>
                            <th class="p-4">Message</th>
                            <th class="p-4">Received Date</th>
                            <th class="p-4 text-right pr-6">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($contacts as $contact)
                            <tr class="hover:bg-gray-50/50 transition">
                                <!-- Name and Email -->
                                <td class="p-4 pl-6">
                                    <div class="font-bold text-gray-800">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                                    <div class="text-xs text-gray-500">{{ $contact->email }}</div>
                                </td>

                                <!-- Service Interest -->
                                <td class="p-4 text-gray-700 font-medium">
                                    {{ $contact->service_interest ?? 'No Service Interest Specified' }}
                                </td>

                                <!-- Message Preview -->
                                <td class="p-4 text-gray-600 max-w-xs">
                                    <p class="line-clamp-2" title="{{ $contact->message }}">
                                        {{ $contact->message }}
                                    </p>
                                </td>

                                <!-- Date -->
                                <td class="p-4 text-gray-500 text-xs">
                                    {{ $contact->created_at->format('M d, Y') }}
                                    <div class="text-[10px] text-gray-400">{{ $contact->created_at->format('h:i A') }}</div>
                                </td>

                                <!-- Actions -->
                                <td class="p-4 text-right pr-6">
                                    <div class="flex items-center justify-end space-x-2">
                                        <!-- Delete Action Button -->
                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this enquiry?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete enquiry">
                                                <i class="fas fa-trash-alt text-base"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination Footer -->
            <div class="p-4 border-t bg-gray-50">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection