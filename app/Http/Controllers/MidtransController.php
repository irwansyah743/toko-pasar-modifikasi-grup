<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class MidtransController extends Controller
{
    public function getToken(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $carts = Cart::content();
        $items = [];
        foreach ($carts as $cart) {
            array_push($items,  [
                'id' => $cart->rowId,
                'price' => $cart->price,
                'quantity' => $cart->qty,
                'name' => $cart->name,
            ]);
        }
        if ($request->discount) {
            array_push($items,  [
                'id' => $request->discount['id'],
                'price' => $request->discount['price'],
                'quantity' => $request->discount['quantity'],
                'name' => $request->discount['name'],
            ]);
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
            ),
            'item_details' => $items,
            'customer_details' => array(
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
            "shipping_address" =>  array(
                "provinsi" => $request->provinsi,
                "address" => $request->address,
                "city" => $request->kabupaten,
                "postal_code" => $request->postCode,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json(['snapToken' => $snapToken]);
    }

    public function paymentPost(Request $request)
    {

        if (Order::where('order_id', $request->order_id)->count() > 0) {
            $validated['shipping_id'] = Shipping::latest()->first()->id;
            $validated['status'] = $request->transaction_status;

            Order::where('order_id', $request->order_id)->update($validated);
        } else {
            $order = new Order();
            $order->user_id = Auth::id();
            $order->status = $request->transaction_status;
            $order->transaction_id = $request->transaction_id;
            $order->order_id = $request->order_id;
            $order->gross_amount = $request->gross_amount;
            $order->payment_type = $request->payment_type;
            $order->created_at = $request->transaction_time;
            $order->payment_code = isset($request->payment_code) ? $request->payment_code : null;
            $order->pdf_url = isset($request->pdf_url) ? $request->pdf_url : null;

            $order->save();

            // Start Send Email 
            $invoice = Order::where('order_id', $request->order_id)->first();
            $data = [
                'order_id' => $request->order_id,
                'time' =>  $request->transaction_time,
                'order_id' => $request->order_id,
                'amount' => $request->gross_amount,
                'name' => $invoice->user->name,
                'email' => $invoice->user->email,
            ];

            Mail::to($invoice->user->email)->send(new OrderMail($data));

            // End Send Email 
        }


        return response()->json(['success' => 'Payment was successfull']);
    }

    public function shippingStore(Request $request)
    {
        $validated['shipping_name'] = $request->name;
        $validated['shipping_email'] = $request->email;
        $validated['shipping_phone'] = $request->phone;
        $validated['post_code'] = $request->postCode;
        $validated['provinsi'] = $request->provinsi;
        $validated['kabupaten'] = $request->kabupaten;
        $validated['kecamatan'] = $request->kecamatan;
        $validated['address'] = $request->address;
        $validated['notes'] = $request->notes;
        $validated['created_at'] = Carbon::now();

        // Insert Shipping
        Shipping::create($validated);
        return response()->json(['success' => 'Shipping info was saved Successfully']);
    }

    public function orderItemStore()
    {
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $carts = Cart::content();
        foreach ($carts as $cart) {
            $item = new OrderItem();
            $item->product_id = $cart->id;
            $item->qty = $cart->qty;
            $item->color = $cart->options->color;
            $item->size = $cart->options->size;
            $item->order_id = Order::latest()->first()->id;
            $item->save();
        }
        Cart::destroy();
        return response()->json(['success' => 'Ordered items were stored Successfully']);
    }

    public function shippingUpdate(Request $request)
    {
        $validated['shipping_id'] = Shipping::latest()->first()->id;

        Order::where('order_id', $request->order_id)->update($validated);
        return response()->json(['success' => 'Shipping info was saved Successfully']);
    }
}