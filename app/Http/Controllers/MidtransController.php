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
        $order_id = rand();

        // STORE TO DATABASE
        $shipping['shipping_name'] = $request->name;
        $shipping['shipping_email'] = $request->email;
        $shipping['shipping_phone'] = $request->phone;
        $shipping['post_code'] = $request->postCode;
        $shipping['provinsi'] = $request->provinsi;
        $shipping['kabupaten'] = $request->kabupaten;
        $shipping['kecamatan'] = $request->kecamatan;
        $shipping['address'] = $request->address;
        $shipping['notes'] = $request->notes;
        $shipping['delivery_status'] = 0;
        $shipping['created_at'] = Carbon::now();

        // Insert Shipping
        Shipping::create($shipping);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->shipping_id = Shipping::latest()->first()->id;
        $order->status = "to be paid";
        $order->order_id =  $order_id;
        $order->order_date = Carbon::now()->format('d F Y');
        $order->order_month = Carbon::now()->format('F');
        $order->order_year = Carbon::now()->format('Y');
        $order->save();

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
        // END STORE TO DATABASE


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
                'order_id' =>  $order_id,
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


    public function sendEmail(Request $request)
    {
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
        Cart::destroy();

        // End Send Email 

        return response()->json(['success' => "Email was sent"]);
    }

    public function hookTransaction(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        // $notif = new \Midtrans\Notification();
        $transaction = $request->transaction_status;
        $fraud = $request->fraud_status;


        $orderModel = Order::where("order_id", $request->order_id)->first();
        if (!$orderModel) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        if ($transaction == 'capture' || $transaction == 'pending' || $transaction == 'settlement') {
            if ($fraud == 'challenge') {
                $order['status'] = 'pending';
            }
            $order['status'] = $transaction;
            $order['transaction_id'] = $request->transaction_id;
            $order['gross_amount'] = $request->gross_amount;
            $order['payment_type'] = $request->payment_type;
            $order['created_at'] = $request->transaction_time;
            $order['payment_code '] = isset($request->payment_code) ? $request->payment_code : null;
            $order['pdf_url'] = isset($request->pdf_url) ? $request->pdf_url : null;
        } else if ($transaction == 'cancel' || $transaction == 'deny' || $transaction == 'expire' || $transaction == 'failure') {
            $order['status'] = $transaction;
        }

        $orderModel->update($order);

        return response()->json(['status' => 'success']);
    }
}