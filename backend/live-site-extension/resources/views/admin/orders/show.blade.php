@extends('admin.main')

@section('admin-content')

<div class="p-6 max-w-3xl">
    <h1 class="text-2xl font-bold text-dark mb-6">Commande / Order #{{ $order->id }}</h1>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg p-6 space-y-4 mb-6">
        <dl class="grid grid-cols-2 gap-4 text-sm">
            <div><dt class="text-gray-500">Client / Customer</dt><dd class="font-medium">{{ $order->customer_name }}</dd></div>
            <div><dt class="text-gray-500">Entreprise / Company</dt><dd class="font-medium">{{ $order->customer_company ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">Email</dt><dd class="font-medium">{{ $order->customer_email ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">Téléphone / Phone</dt><dd class="font-medium">{{ $order->customer_phone }}</dd></div>
            <div><dt class="text-gray-500">Service</dt><dd class="font-medium">{{ $order->service_name }}</dd></div>
            <div><dt class="text-gray-500">Montant / Amount</dt><dd class="font-medium">{{ $order->currency }} {{ number_format($order->amount, 2) }}</dd></div>
            <div><dt class="text-gray-500">Méthode / Method</dt><dd class="font-medium">{{ str_replace('_', ' ', ucfirst($order->payment_method)) }}</dd></div>
            <div><dt class="text-gray-500">Numéro du client / Customer paid from</dt><dd class="font-medium">{{ $order->payment_number ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">ID de transaction / Transaction ID</dt><dd class="font-medium">{{ $order->transaction_id ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">Reçu le / Placed</dt><dd class="font-medium">{{ $order->created_at->format('M j, Y g:ia') }}</dd></div>
        </dl>

        @if ($order->project_details)
            <div>
                <dt class="text-gray-500 text-sm">Détails du projet / Project details</dt>
                <dd class="mt-1 text-gray-900">{{ $order->project_details }}</dd>
            </div>
        @endif
    </div>

    <div class="bg-white shadow-sm rounded-lg p-6">
        <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="flex items-end gap-4">
            @csrf
            <div class="flex-1">
                <label class="block text-sm font-bold text-gray-700 mb-1">Statut / Status</label>
                <select name="status" class="w-full border-gray-300 rounded-md shadow-sm h-12 px-3">
                    @foreach (['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="h-12 px-6 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider hover:bg-blue-600 transition-all">
                Mettre à jour / Update
            </button>
        </form>
    </div>

    <a href="{{ route('admin.orders.index') }}" class="inline-block mt-6 text-sm text-gray-600 hover:underline">&larr; Retour aux commandes / Back to orders</a>
</div>

@endsection
