<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        // Retrieve all customers from the database
        $customers = Customer::all();

        // Return view with customer data
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        // Return view to show customer details
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        // Return view to create a new customer
        return view('admin.customers.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Create a new customer in the database
        Customer::create($request->all());

        // Redirect to customer list with success message
        return redirect()->route('admin.customers')->with('flash_success', 'Customer created successfully.');
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(Customer $customer)
    {
        // Return view to edit customer
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        // Update customer in the database
        $customer->update($request->all());

        // Redirect to customer list with success message
        return redirect()->route('admin.customers')->with('flash_success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the customer by its ID and delete it
            $customer = Customer::findOrFail($id);
            $customer->delete();

            // Redirect with a success message
            return redirect()->route('admin.customers')->with('flash_success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return an error message
            return redirect()->route('admin.customers')->with('flash_warning', 'Failed to delete customer. Please try again.');
        }
    }
}
