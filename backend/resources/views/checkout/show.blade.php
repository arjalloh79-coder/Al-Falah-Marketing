<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order {{ $service->name }} — Al-Falah Marketing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen py-12" x-data="{ method: 'orange_money' }">
    <div class="max-w-2xl mx-auto px-4">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">{{ $service->name }}</h1>
            <p class="mt-1 text-gray-600">{{ $service->short_description }}</p>
            <p class="mt-2 text-xl font-semibold text-gray-900">{{ $service->currency }} {{ number_format($service->price, 2) }}{{ $service->price_label }}</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md text-red-800 text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('checkout.store', $service) }}" class="bg-white shadow-sm rounded-lg p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email (optional)</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Business / company (optional)</label>
                    <input type="text" name="customer_company" value="{{ old('customer_company') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Project details (optional)</label>
                <textarea name="project_details" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('project_details') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Payment method</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach ($methods as $key => $method)
                        <label class="flex items-center gap-2 border rounded-md px-3 py-2 cursor-pointer" :class="method === '{{ $key }}' ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200'">
                            <input type="radio" name="payment_method" value="{{ $key }}" x-model="method" {{ old('payment_method', 'orange_money') === $key ? 'checked' : '' }} class="text-indigo-600">
                            <span class="text-sm">{{ $method['label'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            @foreach ($methods as $key => $method)
                <div x-show="method === '{{ $key }}'" x-cloak class="bg-gray-50 border border-gray-200 rounded-md p-4 space-y-3">
                    <p class="text-sm text-gray-700">{{ $method['instructions'] }}</p>

                    @if ($key === 'card')
                        @unless ($method['gateway_enabled'])
                            <p class="text-sm text-amber-700 font-medium">Card payments aren't available online yet — pick another method above, or contact us directly.</p>
                        @endunless
                    @else
                        <p class="text-sm font-semibold text-gray-900">Send to: {{ $method['receiving_account'] }}</p>

                        @if ($method['requires_payment_number'] ?? false)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ $method['payment_number_label'] }}</label>
                                <input type="text" name="payment_number" value="{{ old('payment_number') }}" x-bind:required="method === '{{ $key }}'" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        @endif

                        @if ($method['requires_transaction_id'] ?? false)
                            <div>
                                <label class="block text-sm font-medium text-gray-700">{{ $method['transaction_id_label'] ?? 'Transaction ID' }}</label>
                                <input type="text" name="transaction_id" value="{{ old('transaction_id') }}" x-bind:required="method === '{{ $key }}'" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        @endif
                    @endif
                </div>
            @endforeach

            <button type="submit" class="w-full h-11 bg-indigo-600 text-white rounded-md font-semibold hover:bg-indigo-700">
                Place order
            </button>
        </form>
    </div>
</body>
</html>
