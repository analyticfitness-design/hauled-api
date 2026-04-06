<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::with(['brand', 'category'])
            ->where('is_active', true);

        if ($request->filled('line')) {
            $query->where('hauled_line', $request->line);
        }

        if ($request->filled('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 12));

        return response()->json($products);
    }

    public function show(string $slug): JsonResponse
    {
        $product = Product::with(['brand', 'category'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json($product);
    }

    public function byLine(string $line): JsonResponse
    {
        $products = Product::with(['brand', 'category'])
            ->where('hauled_line', $line)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return response()->json($products);
    }
}
