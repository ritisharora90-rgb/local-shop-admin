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
// Save Cart
Route::post('/cart', function (Illuminate\Http\Request $request) {

    // 1. Find or create the user's cart record
    $cart = App\Models\Cart::firstOrCreate([
        'user_id' => $request->user_id
    ]);

    // 2. Grab the raw items payload sent from Next.js
    $rawItems = $request->input('items', []);

    // 3. FORCE DECODE BREAK: If Next.js or Laravel treated it as a string,
    // we force it back into a pure, clean PHP array structure here.
    if (is_string($rawItems)) {
        $rawItems = json_decode($rawItems, true);
    }

    // 4. Assign the pure data array straight to the record field
    $cart->items = $rawItems;

    // 5. Save it to Atlas
    $cart->save();

    return response()->json($cart);
});