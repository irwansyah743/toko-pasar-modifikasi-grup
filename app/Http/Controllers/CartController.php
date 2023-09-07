<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public function index()
    {
        return view('front.cart.index');
    }

    public function addToCart(Request $request, $id)
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        $product = Product::find($id);
        if ($product->harga_diskon == NULL) {
            Cart::add([
                'id' => $product->getKey(),
                'name' => $request->nama_produk,
                'qty' => $request->kuantitas_produk,
                'price' => $product->harga_jual,
                'weight' => 1,
                'options' => [
                    'image' => $product->thumbnail_produk,
                    'warna' => $request->warna_produk,
                    'ukuran' => $request->ukuran_produk,
                ],
            ]);
            return response()->json(['success' => 'Successfully Added on Your Cart']);
        } else {
            Cart::add([
                'id' => $product->getKey(),
                'name' => $request->nama_produk,
                'qty' => $request->kuantitas_produk,
                'price' => $product->harga_diskon,
                'weight' => 1,
                'options' => [
                    'image' => $product->thumbnail_produk,
                    'warna' => $request->warna_produk,
                    'ukuran' => $request->ukuran_produk,
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

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
    }

    // Cart Increment
    public function cartIncrement($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        // if (Session::has('coupon')) {

        //     $nama_kupon = Session::get('coupon')['nama_kupon'];
        //     $coupon = Coupon::where('nama_kupon', $nama_kupon)->first();

        //     Session::put('coupon', [
        //         'nama_kupon' => $coupon->nama_kupon,
        //         'diskon_kupon' => $coupon->diskon_kupon,
        //         'discount_amount' => Cart::priceTotal() * $coupon->diskon_kupon / 100,
        //         'total_amount' => Cart::priceTotal() - Cart::priceTotal() * $coupon->diskon_kupon / 100
        //     ]);
        // }

        return response()->json('Increment');
    } // end mehtod

    // Cart Decrement
    public function cartDecrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        // if (Session::has('coupon')) {

        //     $nama_kupon = Session::get('coupon')['nama_kupon'];
        //     $coupon = Coupon::where('nama_kupon', $nama_kupon)->first();

        //     Session::put('coupon', [
        //         'nama_kupon' => $coupon->nama_kupon,
        //         'diskon_kupon' => $coupon->diskon_kupon,
        //         'discount_amount' => Cart::priceTotal() * $coupon->diskon_kupon / 100,
        //         'total_amount' => Cart::priceTotal() - Cart::priceTotal() * $coupon->diskon_kupon / 100
        //     ]);
        // }

        return response()->json('Decrement');
    } // end mehtod

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('nama_kupon', $request->nama_kupon)->where('validitas_kupon', '>=', Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {

            Session::put('coupon', [
                'nama_kupon' => $coupon->nama_kupon,
                'diskon_kupon' => $coupon->diskon_kupon,
                'discount_amount' => Cart::priceTotal() * $coupon->diskon_kupon / 100,
                'total_amount' => Cart::priceTotal() - Cart::priceTotal() * $coupon->diskon_kupon / 100
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function couponCalculation()
    {

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::priceTotal(),
                'nama_kupon' => session()->get('coupon')['nama_kupon'],
                'diskon_kupon' => session()->get('coupon')['diskon_kupon'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        } else {
            return response()->json(array(
                'total' => Cart::priceTotal(),
            ));
        }
    } // end method

    public function couponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    // Checkout Method
    public function checkoutCreate()
    {

        if (Auth::check()) {
            if (Cart::priceTotal() > 0) {
                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::priceTotal();
                // $provinsiList = RajaOngkir::provinsi()->all();

                // $provinsiUser = array_search(Auth::user()->provinsi, array_column($provinsiList, "province"));
                // if (!$provinsiUser) {
                //     $provinsiUser = 0;
                // }else{
                //     $provinsiUser += 1;
                // }

                // $kabupatenList = RajaOngkir::kota()->dariProvinsi($provinsiUser)->get();
                // if (empty($kabupatenList)) {
                //     $kabupatenList = 0;
                // }

                return view('front.checkout.index', compact('carts', 'cartQty', 'cartTotal'));
            } else {
                $notification = array(
                    'message' => 'Your cart is empty',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        } else {
            $notification = array(
                'message' => 'You Need to Login First',
                'alert-type' => 'error'
            );

            return redirect()->route('login')->with($notification);
        }
    } // end method

    public function checkoutStore(Request $request)
    {
        $data['nama_pengiriman'] = $request->nama_pengiriman;
        $data['email_pengiriman'] = $request->email_pengiriman;
        $data['no_telepon_pengiriman'] = $request->no_telepon_pengiriman;
        $data['kode_pos'] = $request->kode_pos;
        $data['provinsi'] = $request->provinsi;
        $data['kabupaten'] = $request->kabupaten;
        $data['kecamatan'] = $request->kecamatan;
        $data['alamat'] = $request->alamat;
        $data['catatan'] = $request->catatan;


        if ($request->payment_method == 'stripe') {
            return view('payment.stripe.index', $data);
        } elseif ($request->payment_method == 'card') {
            return 'card';
        } else {
            return 'cash';
        }
    } // end mehtod.


    // Raja Ongkir
    public function getProvinsi(Request $request)
    {
        $provinsi = RajaOngkir::provinsi()->all();
        return response()->json($provinsi);
    }

    public function getKabupaten(Request $request, $id)
    {
        $kabupaten = RajaOngkir::kota()->dariProvinsi($id)->get();
        return response()->json($kabupaten);
    }

    public function getOngkir(Request $request)
    {
        if(!$request->has('id_kabupaten_asal')){
            return response()->json(['error' => 'id_kabupaten_asal is required']);
        }

        if(!$request->has('id_kabupaten_tujuan')){
            return response()->json(['error' => 'id_kabupaten_tujuan is required']);
        }

        if(!$request->has('berat')){
            return response()->json(['error' => 'berat is required']);
        }

        if(!$request->has('kurir')){
            return response()->json(['error' => 'kurir is required']);
        }

        $ongkir = RajaOngkir::ongkosKirim([
            'origin' => $request->id_kabupaten_asal, // ID kota/kabupaten asal
            'destination' => $request->id_kabupaten_tujuan, // ID kota/kabupaten tujuan
            'weight' => $request->berat, // berat barang dalam gram
            'courier' => $request->kurir, // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        return response()->json($ongkir);
    }
}
