<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // ADMIN PRODUCT LIST (With Pagination for Better UI performance)
    public function index()
    {
        // Pagination ensures your admin panel layout doesn't break if you have hundreds of groceries
        $products = Product::latest()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // API FOR NEXT.JS → ALL PRODUCTS
    public function apiIndex()
    {
        $products = Product::all()->map(function ($product) {
            // Converts internal storage path to absolute URL so Next.js frontend can render it instantly
            if ($product->image && !str_starts_with($product->image, 'http')) {
                $product->image = asset('storage/' . $product->image);
            }
            return $product;
        });

        return response()->json($products, 200);
    }

    // API FOR NEXT.JS → SINGLE PRODUCT
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found'
            ], 404);
        }

        // Format image URL for Next.js detail page
        if ($product->image && !str_starts_with($product->image, 'http')) {
            $product->image = asset('storage/' . $product->image);
        }

        return response()->json($product, 200);
    }

    // ADMIN CREATE PAGE
    public function create()
    {
        return view('admin.products.create');
    }

    // ADMIN STORE (With Complete Validation & Secure Image Upload)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Restricts to real images under 2MB
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect('/admin/products')
            ->with('success', '✨ Grocery product added successfully!');
    }

    // ADMIN EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Throws 404 automatically if id is corrupt

        return view('admin.products.edit', compact('product'));
    }

    // ADMIN UPDATE (With Image Cleanup to save disk space)
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'category'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old asset image from server storage folder so disk stays empty and clean
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect('/admin/products')
            ->with('success', '✅ Product updated successfully!');
    }

    // ADMIN DELETE
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Delete associated file asset before removing database entry
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', '🗑️ Product permanently removed.');
    }
}