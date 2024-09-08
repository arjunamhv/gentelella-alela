<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesInvoice;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class SalesInvoiceController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $invoices = SalesInvoice::all(); // Get all invoices
        return view('admin.sales_invoice.index', compact('invoices'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $salesOrders = SalesOrder::pluck('id', 'id'); // Get all sales orders to populate the dropdown
        return view('admin.sales_invoice.create', compact('salesOrders'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
        ]);

        SalesInvoice::create($request->all());

        return redirect()->route('admin.sales.invoices')->with('flash_success', 'Sales Invoice created successfully.');
    }

    // Display the specified resource
    public function show(SalesInvoice $salesInvoice)
    {
        return view('admin.sales_invoice.show', compact('salesInvoice'));
    }

    // Show the form for editing the specified resource
    public function edit(SalesInvoice $salesInvoice)
    {
        $salesOrders = SalesOrder::pluck('id', 'id'); // Get all sales orders to populate the dropdown
        return view('admin.sales_invoice.edit', compact('salesInvoice', 'salesOrders'));
    }

    // Update the specified resource in storage
    public function update(Request $request, SalesInvoice $salesInvoice)
    {
        $request->validate([
            'sales_order_id' => 'required|exists:sales_orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric',
        ]);

        $salesInvoice->update($request->all());

        return redirect()->route('admin.sales.invoices')->with('flash_success', 'Sales Invoice updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        try {
            $salesInvoice = SalesInvoice::findOrFail($id);
            $salesInvoice->delete();

            return redirect()->route('admin.sales.invoices')->with('flash_success', 'Sales Invoice deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sales.invoices')->with('flash_warning', 'Failed to delete Sales Invoice. Please try again.');
        }
    }
}
