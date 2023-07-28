<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreWishlistRequest;
use App\Http\Requests\UpdateWishlistRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.wishlist.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWishlistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addToWishlist(Product $product)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('id_produk', $product->getKey())->first();
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'id_produk' => $product->getKey(),
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Added On Your Wishlist']);
            } else {
                return response()->json(['error' => 'This Product has Already on Your Wishlist']);
            }
        } else {
            return response()->json(['error' => 'Please Login to Your Account First']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function show(Wishlist $wishlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Wishlist $wishlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWishlistRequest  $request
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWishlistRequest $request, Wishlist $wishlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wishlist  $wishlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wishlist $wishlist)
    {
        //
    }

    public function getWishlistProduct()
    {
        if (Auth::check()) {
            $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();
            return response()->json($wishlist);
        } else {
            return response()->json(['error' => 'Please login first']);
        }
    } // end mehtod 

    public function removeWishlistProduct($id)
    {
        Wishlist::where('user_id', Auth::id())->where('id_produk', $id)->delete();
        return response()->json(['success' => 'Product Successfully Remove']);
    }
}