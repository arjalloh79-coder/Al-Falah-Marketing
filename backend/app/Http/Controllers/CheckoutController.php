<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Show the checkout form for a service — payment method selector with
     * per-method instructions/fields, driven by config/payment_methods.php.
     */
    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        return view('checkout.show', [
            'service' => $service,
            'methods' => config('payment_methods'),
        ]);
    }

    /**
     * Handles both non-card methods (mobile money / bank transfer — "pay externally,
     * submit proof") and card (redirects to Stripe Checkout when configured).
     */
    public function store(Request $request, Service $service): RedirectResponse
    {
        abort_unless($service->is_active, 404);

        $methods = config('payment_methods');

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_company' => ['nullable', 'string', 'max:150'],
            'payment_method' => ['required', 'in:'.implode(',', array_keys($methods))],
            'project_details' => ['nullable', 'string', 'max:5000'],
        ]);

        $method = $methods[$data['payment_method']];

        if ($data['payment_method'] === 'card') {
            return $this->startCardCheckout($service, $data, $method);
        }

        $data = array_merge($data, $request->validate($this->proofValidationRules($method)));

        $order = Order::create([
            'service_id' => $service->id,
            'service_name' => $service->name,
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'] ?? null,
            'customer_phone' => $data['customer_phone'],
            'customer_company' => $data['customer_company'] ?? null,
            'payment_method' => $data['payment_method'],
            'payment_number' => $data['payment_number'] ?? null,
            'transaction_id' => $data['transaction_id'] ?? null,
            'total_amount' => $service->price,
            'status' => 'pending',
            'project_details' => $data['project_details'] ?? null,
        ]);

        return redirect()->route('checkout.confirmation', $order);
    }

    public function confirmation(Order $order): View
    {
        return view('checkout.confirmation', [
            'order' => $order,
            'method' => config('payment_methods.'.$order->payment_method),
        ]);
    }

    /**
     * Handles Stripe's redirect back after a card checkout attempt. Verifies the
     * session status directly with Stripe rather than relying on a webhook — simpler
     * to run correctly on modest hosting, at the cost of not confirming payments that
     * complete after the customer closes the tab before returning (a webhook handles
     * that case too, but needs a public endpoint Stripe can reach — add one later if
     * that becomes a real gap in practice).
     */
    public function cardReturn(Request $request, Service $service): RedirectResponse
    {
        $sessionId = $request->query('session_id');
        abort_unless($sessionId, 400);

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = StripeSession::retrieve($sessionId);

        abort_unless($session->payment_status === 'paid', 402, 'Payment was not completed.');

        $order = Order::create([
            'service_id' => $service->id,
            'service_name' => $service->name,
            'customer_name' => $session->customer_details->name ?? 'Card customer',
            'customer_email' => $session->customer_details->email ?? null,
            'customer_phone' => $session->customer_details->phone ?? 'N/A',
            'payment_method' => 'card',
            'transaction_id' => $session->payment_intent,
            'total_amount' => $service->price,
            'status' => 'confirmed', // Stripe already confirmed payment — no manual verification needed.
        ]);

        return redirect()->route('checkout.confirmation', $order);
    }

    private function startCardCheckout(Service $service, array $data, array $method): RedirectResponse
    {
        if (! ($method['gateway_enabled'] ?? false)) {
            return back()->withErrors(['payment_method' => 'Card payments aren\'t available online yet — please choose another payment method or contact us directly.'])->withInput();
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $checkoutSession = StripeSession::create([
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($service->currency),
                    'product_data' => ['name' => $service->name],
                    'unit_amount' => (int) round($service->price * 100),
                ],
                'quantity' => 1,
            ]],
            'customer_email' => $data['customer_email'] ?? null,
            'success_url' => route('checkout.card-return', $service).'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.show', $service),
        ]);

        return redirect($checkoutSession->url);
    }

    private function proofValidationRules(array $method): array
    {
        $rules = [];

        if ($method['requires_payment_number'] ?? false) {
            $rules['payment_number'] = ['required', 'string', 'max:50'];
        }

        if ($method['requires_transaction_id'] ?? false) {
            $rules['transaction_id'] = ['required', 'string', 'max:100'];
        }

        return $rules;
    }
}
