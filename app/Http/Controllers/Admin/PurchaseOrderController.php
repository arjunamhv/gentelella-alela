<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Product;
use App\Http\Controllers\Controller;

class PurchaseOrderController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('supplier')->get(); // Assuming a relationship with Supplier
        return view('admin.purchase_order.index', compact('purchaseOrders'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $suppliers = Supplier::pluck('name', 'id'); // Get suppliers list
        $products = Product::pluck('name', 'id'); // Add this line to fetch the list of products
        return view('admin.purchase_order.create', compact('suppliers', 'products'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        // Ambil produk berdasarkan product_id
        $product = Product::find($request->input('product_id'));

        // Hitung total_amount berdasarkan harga produk dan quantity
        $totalAmount = $product->price * $request->input('quantity');

        // Simpan data ke database
        PurchaseOrder::create([
            'supplier_id' => $request->input('supplier_id'),
            'order_date' => $request->input('order_date'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'total_amount' => $totalAmount, // Menggunakan hasil perhitungan langsung
            'status' => $request->input('status'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.purchase.orders')->with('flash_success', 'Purchase order created successfully.');
    }


    // Display the specified resource.
    public function show(PurchaseOrder $purchaseOrder)
    {
        return view('admin.purchase_order.show', compact('purchaseOrder'));
    }

    /// Show the form for editing the specified resource.
    public function edit(PurchaseOrder $purchaseOrder)
{
    $suppliers = Supplier::pluck('name', 'id');
    $products = Product::pluck('name', 'id');
    $statuses = ['pending' => 'Pending', 'completed' => 'Completed', 'canceled' => 'Canceled'];

    return view('admin.purchase_order.edit', compact('purchaseOrder', 'suppliers', 'products', 'statuses'));
}

    // Update the specified resource in storage.
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,canceled',
        ]);

        $purchaseOrder->update([
            'supplier_id' => $request->input('supplier_id'),
            'order_date' => $request->input('order_date'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'total_amount' => $request->input('total_amount'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.purchase.orders')->with('flash_success', 'Purchase order updated successfully.');
    }


    // Remove the specified resource from storage.
    public function destroy($id)
    {
        try {
            $purchaseOrder = PurchaseOrder::findOrFail($id);
            $purchaseOrder->delete();

            return redirect()->route('admin.purchase.orders')->with('flash_success', 'Purchase order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.purchase.orders')->with('flash_warning', 'Failed to delete purchase order. Please try again.');
        }
    }
}
