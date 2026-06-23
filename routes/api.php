<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use Illuminate\Http\Request;


// Products
Route::get(
'/products',
[ProductController::class,'apiIndex']
);

Route::get(
'/products/{id}',
[ProductController::class,'show']
);


// Get Cart
Route::get(
'/cart/{user}',
function($user){

return Cart::where(
'user_id',
$user
)->first()

?? [

'items'=>[]

];

}
);


// Save Cart
Route::post(
'/cart',
function(Request $request){

$cart =
Cart::firstOrCreate(
[
'user_id'=>'guest'
]
);

$cart->items =
$request->items;

$cart->save();

return response()->json(
$cart
);

}
);