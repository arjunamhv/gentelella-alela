<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use App\Models\PurchaseInvoice;
use App\Models\Receiving;

class ReceivingController extends Controller
{
    public function index()
    {
        $receivings = Receiving::with('purchaseOrder')->get();
        return view('admin.receiving.index', compact('receivings'));
    }

    public function create()
    {
        $purchaseOrders = PurchaseOrder::pluck('id', 'id');
        return view('admin.receiving.create', compact('purchaseOrders'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'receiving_date' => 'required|date',
            'quantity_received' => 'required|integer|min:1',
        ]);

        // Ambil data Purchase Order berdasarkan ID
        $purchaseOrder = PurchaseOrder::find($request->purchase_order_id);

        // Cek apakah Purchase Order sudah completed
        if ($purchaseOrder->status == 'completed' || $purchaseOrder->status == 'canceled') {
            return redirect()->route('admin.purchase.receiving')->with('flash_warning', 'Cannot receive items for a completed or canceled purchase order.');
        }

        // Hitung total quantity yang sudah diterima untuk Purchase Order ini
        $totalReceived = Receiving::where('purchase_order_id', $request->purchase_order_id)->sum('quantity_received');

        // Tambahkan quantity yang akan diterima sekarang
        $newTotal = $totalReceived + $request->quantity_received;

        // Cek apakah total quantity yang diterima melebihi jumlah yang dipesan
        if ($newTotal > $purchaseOrder->quantity) {
            return redirect()->route('admin.purchase.receiving')->with('flash_warning', 'Received quantity exceeds the ordered quantity.');
        }

        // Jika semua cek berhasil, simpan data Receiving
        Receiving::create($request->all());

        // Update status Purchase Order jika jumlah yang diterima sudah mencukupi
        if ($newTotal == $purchaseOrder->quantity) {
            $purchaseOrder->update(['status' => 'completed']);

            // Buat Purchase Invoice otomatis
            PurchaseInvoice::create([
                'purchase_order_id' => $purchaseOrder->id,
                'invoice_date' => now(),
                'total_amount' => $purchaseOrder->total_amount,
            ]);
        }

        return redirect()->route('admin.purchase.receiving')->with('flash_success', 'Receiving created successfully.');
    }
    public function show(Receiving $receiving)
    {
        // Ensure the receiving model is eager-loaded with any necessary relationships
        // For example, if you need to load related models like PurchaseOrder
        $receiving->load('purchaseOrder');

        // Return the view with the receiving data
        return view('admin.receiving.show', compact('receiving'));
    }

    // Show the form for editing the specified resource.
    public function edit(Receiving $receiving)
    {
        $purchaseOrders = PurchaseOrder::pluck('id', 'id');
        return view('admin.receiving.edit', compact('receiving', 'purchaseOrders'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Receiving $receiving)
    {
        $request->validate([
            'purchase_order_id' => 'required|exists:purchase_orders,id',
            'receiving_date' => 'required|date',
            'quantity_received' => 'required|integer|min:1',
        ]);

        $receiving->update($request->all());

        return redirect()->route('admin.purchase.receiving')->with('flash_success', 'Receiving updated successfully.');
    }
    public function destroy($id)
    {
        try {
            // Find the receiving record by its ID and delete it
            $receiving = Receiving::findOrFail($id);
            $receiving->delete();

            // Redirect with a success message
            return redirect()->route('admin.purchase.receiving')->with('flash_success', 'Receiving deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return an error message
            return redirect()->route('admin.purchase.receiving')->with('flash_warning', 'Failed to delete receiving. Please try again.');
        }
    }
}
