<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product->discount_price == NULL) {
            Cart::add([
                'id' => $product->id,
                'name' => $request->product_name,
                'qty' => $request->product_qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->product_color,
                    'size' => $request->product_size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {
            Cart::add([
                'id' => $product->id,
                'name' => $request->product_name,
                'qty' => $request->product_qty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->product_color,
                    'size' => $request->product_size,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
    } // end mehtod 

    // Mini Cart Section
    public function addMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::priceTotal();



        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal,
        ));
    } // end method 

    /// remove mini cart 
    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
    }

    // Cart Increment 
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        return response()->json('Increment');
    } // end mehtod 

    // Cart Decrement  
    public function cartDecrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        return response()->json('Decrement');
    } // end mehtod 

}