<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private function getAdmin()
    {
        return Admin::where(
            'name',
            session('admin_name')
        )->first();
    }

    // ADMIN PRODUCT LIST
    public function index()
    {
        $admin = $this->getAdmin();

        if (!$admin) {
            return redirect(
                '/admin/login'
            );
        }

        $products =
            Product::where(
                'shop_id',
                $admin->shop_id
            )
            ->latest()
            ->paginate(10);

        return view(
            'admin.products.index',
            compact('products')
        );
    }


    // API → ALL PRODUCTS
    public function apiIndex()
    {
        $products =
            Product::all()->map(
                function ($product) {

                    if (
                        $product->image &&
                        !str_starts_with(
                            $product->image,
                            'http'
                        )
                    ) {
                        $product->image =
                            asset(
                                'storage/' .
                                $product->image
                            );
                    }

                    return $product;
                }
            );

        return response()->json(
            $products
        );
    }


    // API → SINGLE PRODUCT
    public function show($id)
    {
        $product =
            Product::find($id);

        if (!$product) {

            return response()->json([
                'message' =>
                'Product not found'
            ], 404);
        }

        if (
            $product->image &&
            !str_starts_with(
                $product->image,
                'http'
            )
        ) {

            $product->image =
                asset(
                    'storage/' .
                    $product->image
                );
        }

        return response()->json(
            $product
        );
    }


    // CREATE
    public function create()
    {
        return view(
            'admin.products.create'
        );
    }


    // STORE
    public function store(
        Request $request
    )
    {

        $validated =
            $request->validate([

                'name' =>
                'required',

                'price' =>
                'required|numeric',

                'category' =>
                'nullable',

                'description' =>
                'nullable',

                'image' =>
                'nullable|image'

            ]);

        if (
            $request->hasFile(
                'image'
            )
        ) {

            $validated['image'] =
                $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }

        $admin =
            $this->getAdmin();

        if (!$admin) {

            return redirect(
                '/admin/login'
            );
        }

        $validated['shop_id'] =
            $admin->shop_id;

        Product::create(
            $validated
        );

        return redirect(
            '/admin/products'
        )->with(
            'success',
            'Product Added'
        );
    }


    // EDIT
    public function edit($id)
    {
        $product =
            Product::findOrFail(
                $id
            );

        return view(
            'admin.products.edit',
            compact('product')
        );
    }


    // UPDATE
    public function update(
        Request $request,
        $id
    )
    {

        $product =
            Product::findOrFail(
                $id
            );

        $validated =
            $request->validate([

                'name' =>
                'required',

                'price' =>
                'required|numeric',

                'category' =>
                'nullable',

                'description' =>
                'nullable',

                'image' =>
                'nullable|image'

            ]);

        if (
            $request->hasFile(
                'image'
            )
        ) {

            if (
                $product->image
            ) {

                Storage::disk(
                    'public'
                )->delete(
                    $product->image
                );
            }

            $validated['image'] =
                $request
                ->file('image')
                ->store(
                    'products',
                    'public'
                );
        }

        $product->update(
            $validated
        );

        return redirect(
            '/admin/products'
        );
    }


    // DELETE
    public function destroy($id)
    {
        $product =
            Product::find(
                $id
            );

        if (!$product) {

            return back();
        }

        if (
            $product->image
        ) {

            Storage::disk(
                'public'
            )->delete(
                $product->image
            );
        }

        $product->delete();

        return back();
    }
}

