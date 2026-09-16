<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order confirmation — Al-Falah Marketing</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white shadow-sm rounded-lg p-8 text-center">
            @if ($order->status === 'confirmed')
                <div class="text-green-600 text-4xl mb-4">✓</div>
                <h1 class="text-2xl font-bold text-gray-900">Payment confirmed</h1>
                <p class="mt-2 text-gray-600">
                    Your order for <strong>{{ $order->service_name }}</strong> is confirmed. We'll be in touch shortly to get started.
                </p>
            @else
                <div class="text-indigo-600 text-4xl mb-4">⏳</div>
                <h1 class="text-2xl font-bold text-gray-900">Order received</h1>
                <p class="mt-2 text-gray-600">
                    Your order for <strong>{{ $order->service_name }}</strong> ({{ $order->currency ?? 'USD' }} {{ number_format($order->total_amount, 2) }}) is pending confirmation.
                </p>
                <p class="mt-4 text-sm text-gray-500">
                    We're verifying your {{ $method['label'] ?? $order->payment_method }} payment (reference: {{ $order->transaction_id ?? $order->payment_number }}) and will confirm your order shortly.
                </p>
            @endif

            <p class="mt-6 text-sm text-gray-400">Order #{{ $order->id }}</p>
        </div>
    </div>
</body>
</html>
