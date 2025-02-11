<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return response()->json($customer, 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            return response()->json($customer);
        }

        return response()->json(['message' => 'Cliente não encontrado'], 404);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }

        $customer->update($request->all());
        return response()->json($customer);
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Cliente não encontrado'], 404);
        }
        $customer->delete();
        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
