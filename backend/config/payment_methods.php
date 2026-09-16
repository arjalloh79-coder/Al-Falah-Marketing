<?php

// Payment method definitions for the checkout flow. No live gateway is wired up for
// mobile money / bank transfer — this is the "pay externally, submit proof" flow that's
// how these actually work for a business without a payment aggregator agreement:
// the customer sends money via their own mobile money app or bank, then gives us the
// reference to confirm manually in the admin dashboard (Order status: pending -> confirmed).
//
// Fill in the real receiving account details via .env before going live — the defaults
// below are placeholders and will show as "[SET THIS UP]" until then.
//
// transaction_id_label defaults to "Transaction ID" in the view when not set here.

return [
    'orange_money' => [
        'label' => 'Orange Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Your Orange Money number (the one you paid from)',
        'requires_transaction_id' => true,
        'receiving_account' => env('PAYMENT_ORANGE_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => 'Send the total amount to our Orange Money number below via the Orange Money app or *144#, then enter the number you paid from and the transaction ID from your confirmation SMS.',
    ],
    'mtn_money' => [
        'label' => 'MTN Mobile Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Your MTN Mobile Money number (the one you paid from)',
        'requires_transaction_id' => true,
        'receiving_account' => env('PAYMENT_MTN_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => 'Send the total amount to our MTN Mobile Money number below via the MyMTN app or *170#, then enter the number you paid from and the transaction ID from your confirmation SMS.',
    ],
    'moov_money' => [
        'label' => 'Moov Money',
        'requires_payment_number' => true,
        'payment_number_label' => 'Your Moov Money number (the one you paid from)',
        'requires_transaction_id' => true,
        'receiving_account' => env('PAYMENT_MOOV_MONEY_NUMBER', '[SET THIS UP]'),
        'instructions' => 'Send the total amount to our Moov Money number below, then enter the number you paid from and the transaction ID from your confirmation SMS.',
    ],
    'wave' => [
        'label' => 'Wave',
        'requires_payment_number' => true,
        'payment_number_label' => 'Your Wave number (the one you paid from)',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'Wave transaction reference',
        'receiving_account' => env('PAYMENT_WAVE_NUMBER', '[SET THIS UP]'),
        'instructions' => 'Send the total amount via the Wave app to our number below, then enter the number you paid from and the transaction reference shown in your Wave app.',
    ],
    'bank_transfer' => [
        'label' => 'Bank Transfer',
        'requires_payment_number' => false,
        'requires_transaction_id' => true,
        'transaction_id_label' => 'Transfer reference / receipt number',
        'receiving_account' => env('PAYMENT_BANK_DETAILS', '[SET THIS UP — bank name, account name, account number]'),
        'instructions' => 'Transfer the total amount to the bank account below, then enter the reference or receipt number from your transfer confirmation.',
    ],
    'card' => [
        'label' => 'Card (Visa/Mastercard)',
        'requires_payment_number' => false,
        'requires_transaction_id' => false,
        'gateway_enabled' => filled(env('STRIPE_SECRET_KEY')),
        'instructions' => 'Card payments go through a secure checkout link — you\'ll be redirected after placing your order.',
    ],
];
