<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Display a listing of the suppliers.
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.suppliers.index', compact('suppliers'));
    }

    // Show the form for creating a new supplier.
    public function create()
    {
        return view('admin.suppliers.create');
    }

    // Store a newly created supplier in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.suppliers')
            ->with('flash_success', __('views.admin.suppliers.create.success'));
    }

    // Display the specified supplier.
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', compact('supplier'));
    }

    // Show the form for editing the specified supplier.
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    // Update the specified supplier in storage.
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $supplier->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.suppliers')
            ->with('flash_success', __('views.admin.suppliers.edit.success'));
    }

    // Remove the specified supplier from storage.
    public function destroy($id)
    {
        try {
            // Find the supplier by its ID and delete it
            $supplier = Supplier::findOrFail($id);
            $supplier->delete();

            // Redirect with a success message
            return redirect()->route('admin.suppliers')->with('flash_success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return an error message
            return redirect()->route('admin.suppliers')->with('flash_warning', 'Failed to delete supplier. Please try again.');
        }
    }
}
