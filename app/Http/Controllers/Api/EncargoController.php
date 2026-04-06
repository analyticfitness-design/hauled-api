<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Encargo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EncargoController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'marca'           => 'required|string|max:100',
            'producto'        => 'required|string|max:200',
            'talla'           => 'nullable|string|max:20',
            'color'           => 'nullable|string|max:50',
            'link_referencia' => 'nullable|url',
            'presupuesto'     => 'nullable|integer|min:0',
            'notas_cliente'   => 'nullable|string|max:1000',
        ]);

        $whatsappNumber = config('services.whatsapp.number', '573000000000');

        $message = "Hola HAULED! 👋 Quiero hacer un encargo:\n\n"
            . "🏷 Marca: {$validated['marca']}\n"
            . "👕 Producto: {$validated['producto']}\n"
            . (($validated['talla'] ?? null) ? "📏 Talla: {$validated['talla']}\n" : '')
            . (($validated['color'] ?? null) ? "🎨 Color: {$validated['color']}\n" : '')
            . (($validated['link_referencia'] ?? null) ? "🔗 Referencia: {$validated['link_referencia']}\n" : '')
            . (($validated['presupuesto'] ?? null) ? "💰 Presupuesto: $" . number_format($validated['presupuesto'] / 100, 0, ',', '.') . " COP\n" : '')
            . (($validated['notas_cliente'] ?? null) ? "\n📝 Notas: {$validated['notas_cliente']}" : '');

        $waLink = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);

        $encargo = Encargo::create([
            ...$validated,
            'user_id' => $request->user()?->id,
            'status'  => 'recibido',
            'wa_link' => $waLink,
        ]);

        return response()->json([
            'encargo' => $encargo,
            'wa_link' => $waLink,
        ], 201);
    }

    public function index(Request $request): JsonResponse
    {
        $encargos = Encargo::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($encargos);
    }

    public function show(Request $request, int $id): JsonResponse
    {
        $encargo = Encargo::where('user_id', $request->user()->id)
            ->findOrFail($id);

        return response()->json($encargo);
    }
}
