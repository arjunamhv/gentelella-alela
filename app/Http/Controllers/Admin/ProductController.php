<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;


class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // Mengambil semua produk dari database
        $products = Product::with('supplier')->get();

        // Mengembalikan view dengan data produk
        return view('admin.products.index', compact('products'));
    }
    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        // Mengambil data produk dengan supplier-nya menggunakan eager loading
        $product->load('supplier');

        // Mengembalikan view untuk menampilkan detail produk
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        // Mengambil data supplier untuk dropdown
        $suppliers = Supplier::all();

        // Mengembalikan view untuk menambah produk baru
        return view('admin.products.create', compact('suppliers'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        // Menyimpan produk baru ke dalam database
        Product::create($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('admin.products')->with('flash_success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Mengambil data supplier untuk dropdown
        $suppliers = Supplier::all();

        // Mengembalikan view untuk mengedit produk
        return view('admin.products.edit', compact('product', 'suppliers'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        // Update produk di dalam database
        $product->update($request->all());

        // Redirect ke halaman daftar produk dengan pesan sukses
        return redirect()->route('admin.products')->with('flash_success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        try {
            // Find the product by its ID and delete it
            $product = Product::findOrFail($id);
            $product->delete();

            // Redirect with a success message
            return redirect()->route('admin.products')->with('flash_success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            // Handle exceptions and return an error message
            return redirect()->route('admin.products')->with('flash_warning', 'Failed to delete product. Please try again.');
        }
    }
}
