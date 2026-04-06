<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'items'            => 'required|array|min:1',
            'items.*.product_slug' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.size'     => 'nullable|string',
            'address'          => 'required|array',
            'address.name'     => 'required|string',
            'address.phone'    => 'required|string',
            'address.city'     => 'required|string',
            'address.address'  => 'required|string',
        ]);

        $total = 0;
        $itemsData = [];

        foreach ($validated['items'] as $item) {
            $product = Product::where('slug', $item['product_slug'])
                ->where('is_active', true)
                ->firstOrFail();

            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            $itemsData[] = [
                'product_id'    => $product->id,
                'product_title' => $product->title,
                'quantity'      => $item['quantity'],
                'price'         => $product->price,
                'size'          => $item['size'] ?? null,
            ];
        }

        $order = Order::create([
            'user_id'   => $request->user()?->id,
            'reference' => 'HAULED-' . strtoupper(Str::random(8)),
            'total'     => $total,
            'status'    => 'pending',
            'address'   => $validated['address'],
        ]);

        foreach ($itemsData as $item) {
            $order->items()->create($item);
        }

        // Crear pago pendiente
        $payment = Payment::create([
            'order_id'  => $order->id,
            'reference' => $order->reference,
            'amount'    => $total,
            'status'    => 'pending',
        ]);

        return response()->json([
            'order'   => $order->load('items'),
            'payment' => $payment,
            'wompi_redirect' => $this->buildWompiUrl($order, $payment),
        ], 201);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $order = Order::with(['items', 'payments'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($order);
    }

    public function index(Request $request): JsonResponse
    {
        $orders = Order::with(['items'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($orders);
    }

    public function webhook(Request $request): JsonResponse
    {
        // Verificar firma Wompi
        $signature = $request->header('x-event-checksum');
        $data      = $request->all();

        $payment = Payment::where('reference', $data['data']['transaction']['reference'] ?? '')->first();

        if (!$payment) {
            return response()->json(['ok' => false], 404);
        }

        $wompiStatus = $data['data']['transaction']['status'] ?? 'PENDING';

        $statusMap = [
            'APPROVED' => 'approved',
            'DECLINED' => 'declined',
            'VOIDED'   => 'voided',
            'ERROR'    => 'error',
        ];

        $newStatus = $statusMap[$wompiStatus] ?? 'pending';

        $payment->update([
            'status'     => $newStatus,
            'wompi_data' => $data,
        ]);

        if ($newStatus === 'approved') {
            $payment->order->update(['status' => 'paid']);
        }

        return response()->json(['ok' => true]);
    }

    private function buildWompiUrl(Order $order, Payment $payment): string
    {
        $publicKey  = config('services.wompi.public_key', '');
        $currency   = 'COP';
        $amount     = $order->total;
        $reference  = $payment->reference;
        $redirectUrl = rtrim(config('app.frontend_url', 'http://hauled.test'), '/') . '/checkout/confirm';

        return "https://checkout.wompi.co/p/?public-key={$publicKey}&currency={$currency}&amount-in-cents={$amount}&reference={$reference}&redirect-url=" . urlencode($redirectUrl);
    }
}
