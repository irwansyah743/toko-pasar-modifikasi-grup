<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Mail\OrderMail;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class MidtransController extends Controller
{
    public function getToken(Request $request)
    {
        // TODO:
        // 1. Create new field on Shipping to store: ongkir, kurir
        // 2. Insert ongkir on midtrans item_details
        // 3. Add total ongkir to nominal_total

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $carts = Cart::content();
        $id_pesanan = rand();
        $getOngkirRegion = RajaOngkir::kota()->dariProvinsi($request->provinsi)->find($request->kabupaten);

        // STORE TO DATABASE
        $shipping['nama_pengiriman'] = $request->name;
        $shipping['email_pengiriman'] = $request->email;
        $shipping['no_telepon_pengiriman'] = $request->phone;
        $shipping['kode_pos'] = $request->kodePos;
        $shipping['provinsi'] = $getOngkirRegion['province'];
        $shipping['kabupaten'] = $getOngkirRegion['type'] . ' ' . $getOngkirRegion['city_name'];
        $shipping['kecamatan'] = $request->kecamatan;
        $shipping['alamat'] = $request->alamat;
        $shipping['catatan'] = $request->catatan;
        $shipping['status_pengiriman'] = 0;
        $kurirSplit = explode('_', $request->ongkir_choose);
        $shipping['kurir'] = 'JNE ' . $kurirSplit[0];
        $shipping['ongkos_kirim'] = $kurirSplit[1];
        $shipping['created_at'] = Carbon::now();

        // Insert Shipping
        Shipping::create($shipping);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->id_pengiriman = Shipping::latest()->first()->getKey();
        $order->status = "to be paid";
        $order->nominal_total = Cart::total() + $kurirSplit[1];
        $order->id_pesanan =  $id_pesanan;
        $order->tanggal_pesanan = Carbon::now()->format('d F Y');
        $order->bulan_pesanan = Carbon::now()->format('F');
        $order->tahun_pesanan = Carbon::now()->format('Y');
        $order->save();

        $carts = Cart::content();
        foreach ($carts as $cart) {
            $item = new OrderItem();
            $item->id_produk = $cart->id;
            $item->kuantitas = $cart->qty;
            $item->warna = $cart->options->warna;
            $item->ukuran = $cart->options->ukuran;
            $item->id_pesanan = $order->getKey();
            $item->save();
        }
        Cart::destroy();
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

        array_push($items,  [
            'id' => 'JNE_' . $kurirSplit[0],
            'price' => $kurirSplit[1],
            'quantity' => 1,
            'name' => 'Ongkir Ke ' . $getOngkirRegion['type'] . ' ' . $getOngkirRegion['city_name'],
        ]);

        $params = array(
            'transaction_details' => array(
                'order_id' =>  $id_pesanan,
            ),
            'item_details' => $items,
            'customer_details' => array(
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ),
            "shipping_address" =>  array(
                "province" => $request->provinsi,
                "address" => $request->alamat,
                "city" => $request->kabupaten,
                "postal_code" => $request->kodePos,
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->snap_token = $snapToken;
        $order->save();

        return response()->json(['snapToken' => $snapToken, 'id_pesanan' => Order::latest()->first()->getKey()]);
    }


    public function sendEmail(Request $request)
    {
        // Start Send Email
        $invoice = Order::where('id_pesanan', $request->id_pesanan)->first();
        $data = [
            'id_pesanan' => $request->id_pesanan,
            'time' =>  $request->transaction_time,
            'id_pesanan' => $request->id_pesanan,
            'amount' => $request->nominal_total,
            'name' => $invoice->user->name,
            'email' => $invoice->user->email,
            'status' => $request->transaction_status
        ];

        Mail::to($invoice->user->email)->send(new OrderMail($data));


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


        $orderModel = Order::where("id_pesanan", $request->order_id)->first();
        if (!$orderModel) {
            return response()->json([
                'status' => 'error',
            ]);
        }

        $order = [];
        $order['status'] = $transaction;

        if (Str::contains($transaction, ['capture', 'pending', 'settlement'])) {
            if ($fraud == 'challenge') {
                $order['status'] = 'pending';
            }
            $order['id_transaksi'] = $request->id_transaksi;
            $order['nominal_total'] = $request->gross_amount;
            $order['tipe_pembayaran'] = $request->payment_type;
            $order['created_at'] = $request->transaction_time;
            $order['payment_code'] = isset($request->payment_code) ? $request->payment_code : null;
            $order['pdf_url'] = isset($request->pdf_url) ? $request->pdf_url : null;

            if ($transaction == 'capture' || $transaction == 'settlement') {
                // $this->sendEmail($request);
            }
        }

        $orderModel->update($order);

        return response()->json(['status' => 'success']);
    }
}
