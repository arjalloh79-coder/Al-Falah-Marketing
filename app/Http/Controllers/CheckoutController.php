<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\ContentStore;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function show(int $service)
    {
        $item = ContentStore::for('services')->find($service);

        if (! $item || empty($item['is_active'])) {
            abort(404);
        }

        $methods = array_filter(config('payment_methods'), fn ($m) => ! empty($m['enabled']));

        return view('User.checkout', [
            'service' => $item,
            'methods' => $methods,
            'defaultMethod' => array_key_first($methods),
        ]);
    }

    public function store(Request $request, int $service)
    {
        $item = ContentStore::for('services')->find($service);

        if (! $item || empty($item['is_active'])) {
            abort(404);
        }

        $method = $request->input('payment_method');
        $methods = array_filter(config('payment_methods'), fn ($m) => ! empty($m['enabled']));

        if (! isset($methods[$method])) {
            throw ValidationException::withMessages([
                'payment_method' => 'Méthode de paiement invalide. / Invalid payment method.',
            ]);
        }

        $config = $methods[$method];

        if ($method === 'card' && empty($config['gateway_enabled'])) {
            throw ValidationException::withMessages([
                'payment_method' => "Le paiement par carte n'est pas encore disponible. / Card payments aren't available yet.",
            ]);
        }

        $rules = [
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:50',
            'customer_email' => 'nullable|email|max:255',
            'customer_company' => 'nullable|string|max:255',
            'project_details' => 'nullable|string|max:2000',
        ];

        if (! empty($config['requires_payment_number'])) {
            $rules['payment_number'] = 'required|string|max:50';
        }

        if (! empty($config['requires_transaction_id'])) {
            $rules['transaction_id'] = 'required|string|max:100';
        }

        $data = $request->validate($rules);

        // Snapshot the service's name/price at order time so a later edit in
        // the admin services list never rewrites the price on an existing order.
        $order = Order::create([
            'service_id' => $item['id'],
            'service_name' => $item['name_en'] ?: $item['name_fr'],
            'amount' => (int) $item['price'],
            'currency' => $item['currency'] ?? 'USD',
            'customer_name' => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'customer_email' => $data['customer_email'] ?? null,
            'customer_company' => $data['customer_company'] ?? null,
            'project_details' => $data['project_details'] ?? null,
            'payment_method' => $method,
            'payment_number' => $data['payment_number'] ?? null,
            'transaction_id' => $data['transaction_id'] ?? null,
            'status' => 'pending',
        ]);

        if ($method === 'card') {
            return $this->startCardCheckout($order);
        }

        return redirect()->route('checkout.confirmation', $order);
    }

    // Only reachable once STRIPE_SECRET_KEY is set AND `composer require
    // stripe/stripe-php` has been run — the package isn't installed yet.
    protected function startCardCheckout(Order $order)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($order->currency),
                    'product_data' => ['name' => $order->service_name],
                    'unit_amount' => $order->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.card-return', $order) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.show', $order->service_id),
        ]);

        return redirect($session->url);
    }

    public function cardReturn(Request $request, Order $order)
    {
        $sessionId = $request->query('session_id');

        if ($sessionId) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            if ($session->payment_status === 'paid') {
                $order->update([
                    'status' => 'confirmed',
                    'transaction_id' => $session->payment_intent,
                ]);
            }
        }

        return redirect()->route('checkout.confirmation', $order);
    }

    public function confirmation(Order $order)
    {
        return view('User.order-confirmation', ['order' => $order]);
    }
}
