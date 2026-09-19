@extends('admin.main')

@section('admin-content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">Payment Settings</h1>
        <p class="text-gray-500 mt-2">
            These are the accounts customers pay into from the checkout page. A method only shows up on
            checkout once "Active on checkout" is on for it — turning a method off (or leaving it blank)
            hides it from customers instead of showing a broken "[SET THIS UP]" placeholder.
        </p>
    </div>

    @if (session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="settingsForm" action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $mobileMoney = [
                'orange_money' => ['label' => 'Orange Money', 'placeholder' => 'e.g. +224 611 351 302'],
                'mtn_money' => ['label' => 'MTN Mobile Money', 'placeholder' => 'e.g. +232 74 321 916'],
                'moov_money' => ['label' => 'Moov Money', 'placeholder' => 'e.g. +224 622 000 000'],
                'wave' => ['label' => 'Wave', 'placeholder' => 'e.g. +224 610 000 000'],
            ];
        @endphp

        @foreach ($mobileMoney as $key => $info)
            @php
                $number = old("{$key}_number", $settings["{$key}_number"] ?? '');
                $enabledDefault = array_key_exists("{$key}_enabled", $settings)
                    ? (bool) $settings["{$key}_enabled"]
                    : filled($settings["{$key}_number"] ?? null);
                $enabled = old("{$key}_enabled") !== null ? old("{$key}_enabled") === '1' : $enabledDefault;
            @endphp
            <div class="bg-white p-6 rounded-2xl shadow-sm border">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-slate-800">{{ $info['label'] }}</h2>
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <span class="js-status-pill text-xs font-semibold px-2 py-1 rounded-full {{ $enabled ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $enabled ? 'Active on checkout' : 'Hidden from checkout' }}
                        </span>
                        <input type="hidden" name="{{ $key }}_enabled" value="0">
                        <input type="checkbox" name="{{ $key }}_enabled" value="1"
                            class="js-status-toggle h-5 w-9 accent-primary" {{ $enabled ? 'checked' : '' }}>
                    </label>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Number</label>
                        <input type="text" name="{{ $key }}_number" value="{{ $number }}"
                            class="w-full border rounded-lg p-3" placeholder="{{ $info['placeholder'] }}">
                    </div>
                    <div>
                        <label class="block mb-1 text-sm font-medium text-gray-700">Account holder name</label>
                        <input type="text" name="{{ $key }}_name" value="{{ old("{$key}_name", $settings["{$key}_name"] ?? '') }}"
                            class="w-full border rounded-lg p-3" placeholder="e.g. Al-Falah Marketing SARL">
                        <p class="text-xs text-gray-400 mt-1">Shown to customers alongside the number so they can confirm they're sending to the right account.</p>
                    </div>
                </div>
            </div>
        @endforeach

        @php
            $bankEnabledDefault = array_key_exists('bank_enabled', $settings)
                ? (bool) $settings['bank_enabled']
                : filled($settings['bank_name'] ?? $settings['bank_account_number'] ?? $settings['bank_details'] ?? null);
            $bankEnabled = old('bank_enabled') !== null ? old('bank_enabled') === '1' : $bankEnabledDefault;
        @endphp
        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-slate-800">Bank Transfer</h2>
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <span class="js-status-pill text-xs font-semibold px-2 py-1 rounded-full {{ $bankEnabled ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $bankEnabled ? 'Active on checkout' : 'Hidden from checkout' }}
                    </span>
                    <input type="hidden" name="bank_enabled" value="0">
                    <input type="checkbox" name="bank_enabled" value="1"
                        class="js-status-toggle h-5 w-9 accent-primary" {{ $bankEnabled ? 'checked' : '' }}>
                </label>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Bank name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $settings['bank_name'] ?? '') }}"
                        class="w-full border rounded-lg p-3" placeholder="e.g. Ecobank Guinée">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700">Account name</label>
                    <input type="text" name="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name'] ?? '') }}"
                        class="w-full border rounded-lg p-3" placeholder="e.g. Al-Falah Marketing SARL">
                </div>
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium text-gray-700">Account number / IBAN</label>
                <input type="text" name="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number'] ?? '') }}"
                    class="w-full border rounded-lg p-3">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700">Additional details (optional)</label>
                <textarea name="bank_details" rows="2" class="w-full border rounded-lg p-3"
                    placeholder="Branch, SWIFT/BIC code, or any other note customers need">{{ old('bank_details', $settings['bank_details'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800">Card Payments (Stripe)</h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Card checkout runs through Stripe and isn't configured on this server yet — it needs a
                        Stripe secret key and the Stripe PHP package installed, set up directly on the server
                        (not here, since it's a secret key rather than an account number).
                    </p>
                </div>
                <span class="text-xs font-semibold px-2 py-1 rounded-full {{ $cardEnabled ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $cardEnabled ? 'Live' : 'Not set up' }}
                </span>
            </div>
        </div>

        <div class="h-20"></div>

    </form>

</div>

<div id="settingsSaveBar" class="fixed bottom-0 left-0 right-0 z-[9999] bg-white border-t border-gray-200 shadow-[0_-4px_16px_rgba(0,0,0,0.08)]">
    <div class="max-w-3xl mx-auto px-6 py-4 flex justify-end">
        <button type="submit" form="settingsForm" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold text-base hover:bg-blue-700 transition shadow-md">
            Save Settings
        </button>
    </div>
</div>

<script>
    document.querySelectorAll('.js-status-toggle').forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            var pill = toggle.closest('label').querySelector('.js-status-pill');
            if (toggle.checked) {
                pill.textContent = 'Active on checkout';
                pill.classList.remove('bg-gray-100', 'text-gray-500');
                pill.classList.add('bg-green-100', 'text-green-700');
            } else {
                pill.textContent = 'Hidden from checkout';
                pill.classList.remove('bg-green-100', 'text-green-700');
                pill.classList.add('bg-gray-100', 'text-gray-500');
            }
        });
    });

    // Some admin layouts apply `transform` to a wrapper for sidebar
    // animations, which silently turns `position: fixed` descendants into
    // elements positioned relative to that wrapper instead of the real
    // viewport. Re-parent the save bar straight onto <body> so it always
    // sits at the true bottom of the screen regardless of layout.
    var saveBar = document.getElementById('settingsSaveBar');
    document.body.appendChild(saveBar);

    // Moving an already-painted element via appendChild can leave Chrome's
    // compositor with a stale (invisible) layer for it even though layout
    // and computed style are both correct. Forcing the repaint in the same
    // tick as the move isn't enough — it still gets folded into the same
    // stale paint pass. Waiting two animation frames guarantees this runs
    // after the browser's first real paint has already settled, which is
    // when the forced style mutation actually takes effect.
    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            void saveBar.offsetHeight;
            saveBar.style.transform = 'translateZ(0.001px)';
        });
    });
</script>

@endsection
