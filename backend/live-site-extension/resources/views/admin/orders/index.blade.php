{{-- NOTE ON @extends/@section: modeled on the sidebar/nav conventions seen in
     admin/sidebar.blade.php, but the actual admin page layout file wasn't
     pasted. If this doesn't render inside the admin shell, check what
     admin/consultations/index.blade.php (or any other admin page) actually
     extends and match it here — likely a one-line fix. --}}
@extends('admin.layout')

@section('content')

<div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-dark">Commandes / Orders</h1>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Client / Customer</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Service</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Montant / Amount</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Méthode / Method</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Statut / Status</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase">Date</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($orders as $order)
                    <tr>
                        <td class="px-4 py-3 text-sm text-gray-700">#{{ $order->id }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 font-medium">{{ $order->customer_name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $order->service_name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $order->currency }} {{ number_format($order->amount, 2) }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @class([
                                    'bg-amber-100 text-amber-700' => $order->status === 'pending',
                                    'bg-emerald-100 text-emerald-700' => $order->status === 'confirmed',
                                    'bg-blue-100 text-blue-700' => $order->status === 'in_progress',
                                    'bg-gray-200 text-gray-700' => $order->status === 'completed',
                                    'bg-red-100 text-red-700' => $order->status === 'cancelled',
                                ])">
                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $order->created_at->format('M j, Y') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary font-semibold hover:underline">
                                Voir / View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-500">Aucune commande. / No orders yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</div>

@endsection
