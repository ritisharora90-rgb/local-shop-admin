<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Admin;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Get Logged Admin
    private function getAdmin()
    {
        return Admin::where(
            'name',
            session('admin_name')
        )->first();
    }



    // Upload Image → Cloudinary
    private function uploadToCloudinary($file)
    {
        $cloudName =
            env('CLOUDINARY_CLOUD_NAME');

        $apiKey =
            env('CLOUDINARY_API_KEY');

        $apiSecret =
            env('CLOUDINARY_API_SECRET');

        $timestamp =
            time();

        $signature =
            sha1(
                "timestamp={$timestamp}{$apiSecret}"
            );

        $ch =
            curl_init();

        curl_setopt(
            $ch,
            CURLOPT_URL,
            "https://api.cloudinary.com/v1_1/{$cloudName}/image/upload"
        );

        curl_setopt(
            $ch,
            CURLOPT_POST,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_RETURNTRANSFER,
            true
        );

        curl_setopt(
            $ch,
            CURLOPT_POSTFIELDS,
            [

                'file'=>
                new \CURLFile(
                    $file->getRealPath(),
                    $file->getMimeType(),
                    $file->getClientOriginalName()
                ),

                'api_key'=>
                $apiKey,

                'timestamp'=>
                $timestamp,

                'signature'=>
                $signature

            ]
        );

        $response =
            curl_exec($ch);

        curl_close($ch);

        $result =
            json_decode(
                $response,
                true
            );

        return
            $result['secure_url']
            ?? null;
    }



    // ADMIN PRODUCTS
    public function index()
    {
        $admin =
            $this->getAdmin();

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
            compact(
                'products'
            )
        );
    }



    // API PRODUCTS
    public function apiIndex(Request $request)
    {

        $query =
            Product::query();

        if (
            $request->filled(
                'shop_id'
            )
        ) {

            $query->where(
                'shop_id',
                $request->shop_id
            );

        }

        $products =
            $query
            ->latest()
            ->get();

        return response()
            ->json(
                $products
            );
    }



    // SINGLE PRODUCT
    public function show($id)
    {

        $product =
            Product::find($id);

        if (!$product) {

            return response()
                ->json(
                    [
                        'message'=>
                        'Product not found'
                    ],
                    404
                );

        }

        return response()
            ->json(
                $product
            );
    }



    // CREATE PAGE
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

        $admin =
            $this->getAdmin();

        if (!$admin) {

            return redirect(
                '/admin/login'
            );

        }

        $validated =
            $request->validate([

                'name'=>
                'required',

                'price'=>
                'required|numeric',

                'category'=>
                'nullable',

                'description'=>
                'nullable',

                'image'=>
                'nullable|image'

            ]);


        if (
            $request
            ->hasFile(
                'image'
            )
        ) {

            $url =
                $this
                ->uploadToCloudinary(
                    $request
                    ->file(
                        'image'
                    )
                );

            if ($url) {

                $validated['image']
                    =
                    $url;

            }

        }


        $validated['shop_id']
            =
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

        $admin =
            $this->getAdmin();

        $product =
            Product::where(
                'shop_id',
                $admin->shop_id
            )
            ->findOrFail(
                $id
            );

        return view(
            'admin.products.edit',
            compact(
                'product'
            )
        );
    }




    // UPDATE
    public function update(
        Request $request,
        $id
    )
    {

        $admin =
            $this->getAdmin();

        $product =
            Product::where(
                'shop_id',
                $admin->shop_id
            )
            ->findOrFail(
                $id
            );

        $validated =
            $request->validate([

                'name'=>
                'required',

                'price'=>
                'required|numeric',

                'category'=>
                'nullable',

                'description'=>
                'nullable',

                'image'=>
                'nullable|image'

            ]);


        if (
            $request
            ->hasFile(
                'image'
            )
        ) {

            $url =
                $this
                ->uploadToCloudinary(
                    $request
                    ->file(
                        'image'
                    )
                );

            if ($url) {

                $validated['image']
                    =
                    $url;

            }

        }


        $product
            ->update(
                $validated
            );

        return redirect(
            '/admin/products'
        )
        ->with(
            'success',
            'Product Updated'
        );

    }




    // DELETE
    public function destroy($id)
    {

        $admin =
            $this->getAdmin();

        $product =
            Product::where(
                'shop_id',
                $admin->shop_id
            )
            ->find(
                $id
            );

        if (!$product) {
            return back();
        }

        $product->delete();

        return back()
            ->with(
                'success',
                'Product Deleted'
            );
    }

}
