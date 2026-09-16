<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lead: {{ trim($lead->first_name.' '.$lead->last_name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div><dt class="text-gray-500">Source</dt><dd class="font-medium">{{ str($lead->source)->headline() }}</dd></div>
                    <div><dt class="text-gray-500">Business</dt><dd class="font-medium">{{ $lead->business ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Email</dt><dd class="font-medium">{{ $lead->email ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Phone</dt><dd class="font-medium">{{ $lead->phone ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Service interest</dt><dd class="font-medium">{{ $lead->service_interest ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Received</dt><dd class="font-medium">{{ $lead->created_at->format('M j, Y g:ia') }}</dd></div>
                </dl>

                @if ($lead->message)
                    <div>
                        <dt class="text-gray-500 text-sm">Message</dt>
                        <dd class="mt-1 text-gray-900">{{ $lead->message }}</dd>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach (['new', 'replied', 'needs_verification', 'archived_spam'] as $status)
                                <option value="{{ $status }}" {{ $lead->status === $status ? 'selected' : '' }}>{{ str($status)->headline() }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label for="next_step" value="Next step" />
                        <x-text-input id="next_step" name="next_step" type="text" class="mt-1 block w-full" value="{{ old('next_step', $lead->next_step) }}" />
                    </div>

                    <div>
                        <x-input-label for="notes" value="Notes" />
                        <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('notes', $lead->notes) }}</textarea>
                    </div>

                    <x-primary-button>Update</x-primary-button>
                </form>
            </div>

            <a href="{{ route('admin.leads.index') }}" class="text-sm text-gray-600">&larr; Back to leads</a>
        </div>
    </div>
</x-app-layout>
