<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Order #{{ $order->id }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('status'))
                <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('status') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <dl class="grid grid-cols-2 gap-4 text-sm">
                    <div><dt class="text-gray-500">Customer</dt><dd class="font-medium">{{ $order->customer_name }}</dd></div>
                    <div><dt class="text-gray-500">Company</dt><dd class="font-medium">{{ $order->customer_company ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Email</dt><dd class="font-medium">{{ $order->customer_email ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Phone</dt><dd class="font-medium">{{ $order->customer_phone }}</dd></div>
                    <div><dt class="text-gray-500">Service</dt><dd class="font-medium">{{ $order->service_name }}</dd></div>
                    <div><dt class="text-gray-500">Amount</dt><dd class="font-medium">${{ number_format($order->total_amount, 2) }}</dd></div>
                    <div><dt class="text-gray-500">Payment method</dt><dd class="font-medium">{{ str($order->payment_method)->headline() }}</dd></div>
                    <div><dt class="text-gray-500">Customer paid from</dt><dd class="font-medium">{{ $order->payment_number ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Transaction / reference ID</dt><dd class="font-medium">{{ $order->transaction_id ?? '—' }}</dd></div>
                    <div><dt class="text-gray-500">Placed</dt><dd class="font-medium">{{ $order->created_at->format('M j, Y g:ia') }}</dd></div>
                </dl>

                @if ($order->project_details)
                    <div>
                        <dt class="text-gray-500 text-sm">Project details</dt>
                        <dd class="mt-1 text-gray-900">{{ $order->project_details }}</dd>
                    </div>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex items-end gap-4">
                    @csrf
                    @method('PUT')
                    <div class="flex-1">
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach (['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ str($status)->headline() }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-primary-button>Update</x-primary-button>
                </form>
            </div>

            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-600">&larr; Back to orders</a>
        </div>
    </div>
</x-app-layout>
