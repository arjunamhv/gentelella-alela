<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesInvoice;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    // Display a listing of the sales orders, including associated products.
    public function index()
    {
        $salesOrders = SalesOrder::with('product')->get();

        return view('admin.sales_order.index', compact('salesOrders'));
    }

    // Show the form for creating a new sales order.
    public function create()
    {
        // Get all customers and products for the dropdowns
        $customers = Customer::pluck('name', 'id')->toArray();
        $products = Product::pluck('name', 'id')->toArray();

        return view('admin.sales_order.create', compact('customers', 'products'));
    }

    // Store a newly created sales order in storage.
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        // Find the product by its ID
        $product = Product::findOrFail($request->product_id);

        // Check if the product has enough stock
        if ($product->stock < $request->quantity) {
            // Redirect back with an error message if stock is insufficient
            return redirect()->back()
                ->with('flash_warning', 'Insufficient stock for the selected product.');
        }

        // Calculate the total amount by multiplying the product's price with the quantity
        $totalAmount = $product->price * $request->quantity;

        // Update the product's stock
        $product->update(['stock' => $product->stock - $request->quantity]);

        // Create the sales order with the request data, including the calculated total amount
        $salesOrder = SalesOrder::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'order_date' => $request->order_date,
            'status' => $request->status,
            'total_amount' => $totalAmount,
        ]);

        // Check if the status is 'completed' and create a sales invoice if it is
        if ($request->status === 'completed') {
            SalesInvoice::create([
                'sales_order_id' => $salesOrder->id,
                'invoice_date' => now(),
                'total_amount' => $totalAmount,
            ]);
        }

        // Redirect to the sales orders index with a success message
        return redirect()->route('admin.sales.orders')
            ->with('flash_success', 'Sales order created successfully.');
    }



    // Display the specified sales order including associated product.
    public function show(SalesOrder $salesOrder)
    {
        // Load the related product data
        $salesOrder->load('product');

        return view('admin.sales_order.show', compact('salesOrder'));
    }

    // Show the form for editing the specified sales order.
    public function edit(SalesOrder $salesOrder)
    {
        // Load related data and prepare options for dropdowns
        $customers = Customer::pluck('name', 'id')->toArray();
        $products = Product::pluck('name', 'id')->toArray();
        $statuses = [
            'pending' => 'Pending',
            'completed' => 'Completed',
            'canceled' => 'Canceled',
        ];

        return view('admin.sales_order.edit', [
            'salesOrder' => $salesOrder,
            'customers' => $customers,
            'products' => $products,
            'statuses' => $statuses,
        ]);
    }

    // Update the specified sales order in storage.
    public function update(Request $request, SalesOrder $salesOrder)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'order_date' => 'required|date',
            'status' => 'required|string|max:255',
        ]);

        // Find the new product if it has changed
        $newProduct = Product::findOrFail($request->product_id);

        // Calculate the new total amount
        $totalAmount = $newProduct->price * $request->quantity;

        // Adjust stock if the product or quantity has changed
        if ($salesOrder->product_id != $request->product_id || $salesOrder->quantity != $request->quantity) {
            // Revert the stock of the old product
            $oldProduct = Product::findOrFail($salesOrder->product_id);
            $oldProduct->update(['stock' => $oldProduct->stock + $salesOrder->quantity]);

            // Check stock for the new product
            if ($newProduct->stock < $request->quantity) {
                return redirect()->back()
                    ->with('flash_warning', 'Insufficient stock for the selected product.');
            }

            // Deduct the new stock
            $newProduct->update(['stock' => $newProduct->stock - $request->quantity]);
        }

        // Create a sales invoice if the status is completed
        if ($request->status === 'completed') {
            SalesInvoice::create([
                'sales_order_id' => $salesOrder->id,
                'invoice_date' => now(),
                'total_amount' => $totalAmount,
            ]);
        }

        // Update the sales order with the new data
        $salesOrder->update([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'order_date' => $request->order_date,
            'total_amount' => $totalAmount,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.sales.orders')
            ->with('flash_success', 'Sales order updated successfully.');
    }


    // Remove the specified sales order from storage.
    public function destroy(SalesOrder $salesOrder)
    {
        try {
            // Revert stock before deleting the sales order
            $product = Product::findOrFail($salesOrder->product_id);
            $product->update(['stock' => $product->stock + $salesOrder->quantity]);

            $salesOrder->delete();

            return redirect()->route('admin.sales.orders')
                ->with('flash_success', 'Sales order deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.sales.orders')
                ->with('flash_warning', 'Failed to delete sales order. Please try again.');
        }
    }
}
