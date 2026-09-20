<?php

// Per-method config. Account details are managed via the admin Settings page
// (storage/app/content/settings.json), falling back to .env (legacy) and
// then to a "[SET THIS UP]" placeholder.
//
// A method only appears on checkout when it's "enabled". Enabled defaults to
// true the moment an admin fills in that method's account details, so a
// freshly-installed site doesn't show half-empty "[SET THIS UP]" options to
// real customers — but the admin can flip a method off (temporarily stop
// taking Wave, say) or force one on, regardless of whether it's filled in,
// via the explicit *_enabled flag in Settings.
$settingsFile = storage_path('app/content/settings.json');
$settings = [];
if (is_file($settingsFile)) {
    $settings = json_decode(file_get_contents($settingsFile), true) ?: [];
}

$mobileMoneyAccount = function (string $numberKey, string $nameKey, string $envVar) use ($settings) {
    $number = $settings[$numberKey] ?? env($envVar, '');
    $name = $settings[$nameKey] ?? '';

    if ($number === '' || $number === null) {
        return '[SET THIS UP]';
    }

    return $name !== '' ? "{$number} ({$name})" : $number;
};

$mobileMoneyEnabled = function (string $numberKey, string $enabledKey) use ($settings) {
    if (array_key_exists($enabledKey, $settings)) {
        return (bool) $settings[$enabledKey];
    }

    return filled($settings[$numberKey] ?? null);
};

$bankAccount = function () use ($settings) {
    $lines = array_filter([
        $settings['bank_name'] ?? '',
        $settings['bank_account_name'] ?? '',
        $settings['bank_account_number'] ?? '',
        $settings['bank_details'] ?? '', // legacy free-text field / extra notes (SWIFT, branch, etc.)
    ], fn ($line) => trim((string) $line) !== '');

    return $lines ? implode("\n", $lines) : env('PAYMENT_BANK_DETAILS', '[SET THIS UP]');
};

$bankEnabled = array_key_exists('bank_enabled', $settings)
    ? (bool) $settings['bank_enabled']
    : filled($settings['bank_name'] ?? $settings['bank_account_number'] ?? $settings['bank_details'] ?? null);

return [
    'orange_money' => [
        'label' => 'Orange Money',
        'enabled' => $mobileMoneyEnabled('orange_money_number', 'orange_money_enabled'),
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => $mobileMoneyAccount('orange_money_number', 'orange_money_name', 'PAYMENT_ORANGE_MONEY_NUMBER'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Orange Money, puis indiquez votre numéro et l'ID de transaction reçu par SMS. / Send the amount to the number below via Orange Money, then enter your number and the transaction ID from your confirmation SMS.",
    ],

    'mtn_money' => [
        'label' => 'MTN Mobile Money',
        'enabled' => $mobileMoneyEnabled('mtn_money_number', 'mtn_money_enabled'),
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => $mobileMoneyAccount('mtn_money_number', 'mtn_money_name', 'PAYMENT_MTN_MONEY_NUMBER'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via MTN Mobile Money, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via MTN Mobile Money, then enter your number and the transaction ID.",
    ],

    'moov_money' => [
        'label' => 'Moov Money',
        'enabled' => $mobileMoneyEnabled('moov_money_number', 'moov_money_enabled'),
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => $mobileMoneyAccount('moov_money_number', 'moov_money_name', 'PAYMENT_MOOV_MONEY_NUMBER'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Moov Money, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via Moov Money, then enter your number and the transaction ID.",
    ],

    'wave' => [
        'label' => 'Wave',
        'enabled' => $mobileMoneyEnabled('wave_number', 'wave_enabled'),
        'requires_payment_number' => true,
        'payment_number_label' => 'Numéro utilisé pour payer / Number you paid from',
        'requires_transaction_id' => true,
        'transaction_id_label' => 'ID de transaction / Transaction ID',
        'receiving_account' => $mobileMoneyAccount('wave_number', 'wave_name', 'PAYMENT_WAVE_NUMBER'),
        'instructions' => "Envoyez le montant au numéro ci-dessous via Wave, puis indiquez votre numéro et l'ID de transaction. / Send the amount to the number below via Wave, then enter your number and the transaction ID.",
    ],

    'bank_transfer' => [
        'label' => 'Virement bancaire / Bank Transfer',
        'enabled' => $bankEnabled,
        'requires_payment_number' => false,
        'requires_transaction_id' => true,
        'transaction_id_label' => 'Référence du virement / Transfer reference',
        'receiving_account' => $bankAccount(),
        'instructions' => 'Effectuez un virement vers le compte ci-dessous, puis indiquez la référence de votre virement. / Transfer to the account below, then enter your transfer reference.',
    ],

    // Requires `composer require stripe/stripe-php` before this can actually
    // be enabled — not installed on the live app as of this writing. Stays
    // disabled (hidden behind gateway_enabled) until both the package and
    // STRIPE_SECRET_KEY are in place. Not manageable from the Settings page:
    // the secret key belongs in .env, never in the JSON settings file.
    'card' => [
        'label' => 'Carte bancaire / Card',
        'enabled' => filled(env('STRIPE_SECRET_KEY')),
        'requires_payment_number' => false,
        'requires_transaction_id' => false,
        'gateway_enabled' => filled(env('STRIPE_SECRET_KEY')),
        'instructions' => 'Paiement sécurisé par carte via Stripe. / Secure card payment via Stripe.',
    ],
];
