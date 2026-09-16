<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderApiController extends Controller
{
    /**
     * Public order creation (rate-limited in routes/api.php).
     * Payment is captured as a method + reference/transaction id, not processed here —
     * see docs/custom-backend-plan.md for why real gateway integration is a separate project.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id'],
            'customer_name' => ['required', 'string', 'max:150'],
            'customer_email' => ['nullable', 'email', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:50'],
            'customer_company' => ['nullable', 'string', 'max:150'],
            'payment_method' => ['required', 'in:orange_money,mtn_money,wave,moov_money,bank_transfer,card'],
            'payment_number' => ['nullable', 'string', 'max:50'],
            'transaction_id' => ['nullable', 'string', 'max:100'],
            'project_details' => ['nullable', 'string', 'max:5000'],
        ]);

        $service = Service::findOrFail($data['service_id']);

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

        return response()->json([
            'message' => 'Order received — we\'ll confirm shortly.',
            'order_id' => $order->id,
        ], 201);
    }
}
