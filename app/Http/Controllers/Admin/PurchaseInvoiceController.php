<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseInvoice;

class PurchaseInvoiceController extends Controller
{
    public function index()
    {
        $purchaseInvoices = PurchaseInvoice::with('purchaseOrder')->get(); // Mengambil semua invoice dengan relasi purchaseOrder
        return view('admin.purchase_invoice.index', compact('purchaseInvoices'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        $purchaseOrders = PurchaseOrder::where('status', 'completed')->pluck('id', 'id');
        return view('admin.purchase_invoice.create', compact('purchaseOrders'));
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        PurchaseInvoice::create($request->all());

        return redirect()->route('admin.purchase.invoice')->with('flash_success', 'Purchase Invoice created successfully.');
    }

    // Display the specified resource
    public function show(PurchaseInvoice $purchaseInvoice)
    {
        return view('admin.purchase_invoice.show', compact('purchaseInvoice'));
    }

    // Show the form for editing the specified resource
    public function edit(PurchaseInvoice $purchaseInvoice)
    {
        $purchaseOrders = PurchaseOrder::where('status', 'completed')->pluck('id', 'id');
        return view('admin.purchase_invoice.edit', compact('purchaseInvoice', 'purchaseOrders'));
    }

    // Update the specified resource in storage
    public function update(Request $request, PurchaseInvoice $purchaseInvoice)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'invoice_date' => 'required|date',
            'total_amount' => 'required|numeric|min:0',
        ]);

        $purchaseInvoice->update($request->all());

        return redirect()->route('admin.purchase.invoice')->with('flash_success', 'Purchase Invoice updated successfully.');
    }

    // Remove the specified resource from storage
    public function destroy(PurchaseInvoice $purchaseInvoice)
    {
        try {
            $purchaseInvoice->delete();

            return redirect()->route('admin.purchase.invoice')->with('flash_success', 'Purchase Invoice deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase.invoice')->with('flash_warning', 'Failed to delete Purchase Invoice. Please try again.');
        }
    }
}
