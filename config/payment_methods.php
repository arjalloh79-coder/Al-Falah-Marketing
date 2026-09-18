<?php

// Per-method config, sourced from .env. Nothing here is hardcoded so account
// numbers can be updated without a code change. Until the PAYMENT_*_NUMBER
// vars are set, checkout shows "[SET THIS UP]" for that method.
return [
    'orange_money' => [
        'label' => 'Orange Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => env('PAYMENT_ORANGE_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Orange Money, puis indiquez votre numéro et l'ID de transaction reçu par SMS. / Send the amount to the number below via Orange Money, then enter your number and the transaction ID from your confirmation SMS.",
    ],

    'mtn_money' => [
        'label' => 'MTN Mobile Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => env('PAYMENT_MTN_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via MTN Mobile Money, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via MTN Mobile Money, then enter your number and the transaction ID.",
    ],

    'moov_money' => [
        'label' => 'Moov Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => env('PAYMENT_MOOV_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Moov Money, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via Moov Money, then enter your number and the transaction ID.",
    ],

    'wave' => [
        'label' => 'Wave',
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => env('PAYMENT_WAVE_NUMBER', '[SET THIS UP]'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Wave, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via Wave, then enter your number and the transaction ID.",
    ],

    'bank_transfer' => [
        'label' => 'Virement bancaire / Bank Transfer',
        'requires_payment_number' => false,
        'requires_transaction_id' => true,
        'transaction_id_label' => 'Référence du virement / Transfer reference',
        'receiving_account' => env('PAYMENT_BANK_DETAILS', '[SET THIS UP]'),
        'instructions' => 'Effectuez un virement vers le compte ci-dessous, puis indiquez la référence de votre virement. / Transfer to the account below, then enter your transfer reference.',
    ],

    // Requires `composer require stripe/stripe-php` before this can actually
    // be enabled — not installed on the live app as of this writing. Stays
    // disabled (hidden behind gateway_enabled) until both the package and
    // STRIPE_SECRET_KEY are in place.
    'card' => [
        'label' => 'Carte bancaire / Card',
        'requires_payment_number' => false,
        'requires_transaction_id' => false,
        'gateway_enabled' => filled(env('STRIPE_SECRET_KEY')),
        'instructions' => 'Paiement sécurisé par carte via Stripe. / Secure card payment via Stripe.',
    ],
];
