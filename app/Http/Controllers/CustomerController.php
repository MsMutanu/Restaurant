<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    // Get all customers
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Create a new customer
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'contact' => 'required|numeric',
        ]);

        $customer = new Customer;
        $customer->cust_id = 'CUST' .Str::random(4); // Generate a random string with 4 characters
        $customer->name = $request->input('name');
        $customer->contact = $request->input('contact');
        $customer-> save();

        return response()->json([
            'message' => 'Customer created successfully',
            'customer' => $customer,
        ]);
    }

    // Get a single customer by id
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    // Update a customer by id
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'contact' => 'required|numeric',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($validatedData);

        return response()->json([
            'message' => 'Customer updated successfully',
            'customer' => $customer,
        ]);
    }

    // Delete a customer by id
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json([
            'message' => 'Customer deleted successfully',
        ]);
    }
}
