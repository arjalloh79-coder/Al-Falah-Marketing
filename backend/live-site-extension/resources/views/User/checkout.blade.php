@extends('User.main')

@section('title', ($service['name_en'] ?: $service['name_fr']) . ' — Al-Falah Marketing')

@section('main-section')

<section id="checkout" class="py-20 lg:py-32 bg-white" x-data="{ method: 'orange_money' }">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <div class="inline-block px-4 py-2 bg-muted rounded-md mb-6">
                <span class="text-primary font-semibold text-sm uppercase tracking-wider">Commander / Order</span>
            </div>
            <h1 class="text-3xl lg:text-4xl font-bold text-dark mb-3 tracking-tighter">
                {{ $service['name_en'] ?: $service['name_fr'] }}
            </h1>
            @if(!empty($service['description_en']) || !empty($service['description_fr']))
                <p class="text-gray-600 mb-4">{{ $service['description_en'] ?: $service['description_fr'] }}</p>
            @endif
            <p class="text-2xl font-bold text-primary">
                {{ $service['currency'] ?? 'USD' }} {{ number_format($service['price'], 2) }}
                @if(($service['period'] ?? 'once') !== 'once')
                    <span class="text-base font-normal text-gray-500">/ {{ $service['period'] }}</span>
                @endif
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-8 p-4 bg-red-50 border border-red-200 rounded-md text-red-800 text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store', $service['id']) }}" class="bg-muted rounded-lg p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Nom complet / Full name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                        class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Téléphone / Phone</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                        class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Email (optionnel / optional)</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                        class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Entreprise / Company (optionnel / optional)</label>
                    <input type="text" name="customer_company" value="{{ old('customer_company') }}"
                        class="w-full h-14 bg-white rounded-md px-4 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-dark mb-2 uppercase tracking-wider">Détails du projet / Project details (optionnel / optional)</label>
                <textarea name="project_details" rows="3"
                    class="w-full bg-white rounded-md px-4 py-3 text-dark focus:outline-none focus:ring-2 focus:ring-primary transition-all resize-none">{{ old('project_details') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-dark mb-3 uppercase tracking-wider">Méthode de paiement / Payment method</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach ($methods as $key => $m)
                        <label class="flex items-center gap-2 border rounded-md px-3 py-3 cursor-pointer bg-white"
                            :class="method === '{{ $key }}' ? 'border-primary ring-1 ring-primary' : 'border-gray-200'">
                            <input type="radio" name="payment_method" value="{{ $key }}" x-model="method"
                                {{ old('payment_method', 'orange_money') === $key ? 'checked' : '' }} class="text-primary">
                            <span class="text-sm font-semibold">{{ $m['label'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            @foreach ($methods as $key => $m)
                <div x-show="method === '{{ $key }}'" x-cloak class="bg-white border border-gray-200 rounded-md p-4 space-y-3">
                    <p class="text-sm text-gray-700">{{ $m['instructions'] }}</p>

                    @if ($key === 'card')
                        @unless ($m['gateway_enabled'])
                            <p class="text-sm text-amber-700 font-semibold">
                                Le paiement par carte n'est pas encore disponible — choisissez une autre méthode ou contactez-nous.
                                / Card payments aren't available online yet — pick another method above, or contact us directly.
                            </p>
                        @endunless
                    @else
                        <p class="text-sm font-bold text-dark">
                            Envoyer à / Send to: {{ $m['receiving_account'] }}
                        </p>

                        @if ($m['requires_payment_number'] ?? false)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ $m['payment_number_label'] }}</label>
                                <input type="text" name="payment_number" value="{{ old('payment_number') }}"
                                    x-bind:required="method === '{{ $key }}'"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-12 px-3">
                            </div>
                        @endif

                        @if ($m['requires_transaction_id'] ?? false)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ $m['transaction_id_label'] ?? 'Transaction ID' }}</label>
                                <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                                    x-bind:required="method === '{{ $key }}'"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm h-12 px-3">
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach

            <button type="submit" class="w-full h-16 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider transition-all duration-200 hover:scale-105 hover:bg-blue-600">
                Confirmer la commande / Place order
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
    </div>
</section>

@endsection
