<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['user', 'customer', 'product'])->get();
        return response()->json($sales);
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->validated());
        return response()->json($sale, 201);
    }

    public function show($id)
    {
        $sale = Sale::with(['user', 'customer', 'product'])->find($id);

        if ($sale) {
            return response()->json($sale);
        }

        return response()->json(['message' => 'Venda não encontrada'], 404);
    }

    public function update(UpdateSaleRequest $request, $id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        $sale->update($request->validated());
        return response()->json($sale);
    }

    public function destroy($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['message' => 'Venda não encontrada'], 404);
        }

        $sale->delete();
        return response()->json(['message' => 'Sale deleted successfully']);
    }
}
