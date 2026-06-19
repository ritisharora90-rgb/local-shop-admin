<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();

        return view('admin.products.index',
        compact('products'));
    }
    public function edit($id)
{
$product=Product::find($id);

return view(
'admin.products.edit',
compact('product')
);
}



public function update(Request $request,$id)
{
    $product = Product::find($id);

    $product->name = $request->name;

    $product->price = $request->price;

    if($request->hasFile('image'))
    {
        $path =
        $request
        ->file('image')
        ->store(
            'products',
            'public'
        );

        $product->image = $path;
    }

    $product->save();

    return redirect(
        '/admin/products'
    );
}

   
    public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()
            ->back()
            ->with('error', 'Product not found');
    }

    $product->delete();

    return redirect()
        ->back()
        ->with(
            'success',
            'Product deleted successfully'
        );
}

    public function create()
    {
        return view('admin.products.create');
    }



    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'price'=>'required',
        ]);


        Product::create([

            'name'=>$request->name,

            'price'=>$request->price,

            'category'=>$request->category,

            'description'=>$request->description,

            'image'=>$request->image

        ]);


        return redirect('/admin/products')
        ->with('success','Product Added');

    }

}