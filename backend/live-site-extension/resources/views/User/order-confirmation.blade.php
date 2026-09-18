@extends('layouts.app')

@section('title', 'Commande confirmée / Order received — Al-Falah Marketing')

@section('main-section')

<section class="py-20 lg:py-32 bg-white">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-check text-white text-3xl"></i>
        </div>

        <h1 class="text-3xl lg:text-4xl font-bold text-dark mb-4 tracking-tighter">
            Merci ! / Thank you!
        </h1>

        @if ($order->status === 'confirmed')
            <p class="text-lg text-gray-600 mb-8">
                Votre paiement a été confirmé. Notre équipe vous contactera sous peu.
                / Your payment has been confirmed. Our team will be in touch shortly.
            </p>
        @else
            <p class="text-lg text-gray-600 mb-8">
                Votre commande a été reçue et est en attente de confirmation du paiement.
                Notre équipe vérifiera votre paiement et vous contactera sous peu.
                / Your order has been received and is pending payment confirmation.
                Our team will verify your payment and contact you shortly.
            </p>
        @endif

        <div class="bg-muted rounded-lg p-6 text-left space-y-2 mb-8">
            <p><span class="font-bold text-dark">Commande / Order:</span> #{{ $order->id }}</p>
            <p><span class="font-bold text-dark">Service:</span> {{ $order->service_name }}</p>
            <p><span class="font-bold text-dark">Montant / Amount:</span> {{ $order->currency }} {{ number_format($order->amount, 2) }}</p>
            <p><span class="font-bold text-dark">Statut / Status:</span> {{ ucfirst($order->status) }}</p>
        </div>

        <a href="{{ route('home') }}" class="inline-block h-14 leading-[3.5rem] px-8 bg-primary text-white rounded-md font-bold text-sm uppercase tracking-wider hover:bg-blue-600 transition-all">
            Retour à l'accueil / Back to home
        </a>
    </div>
</section>

@endsection
