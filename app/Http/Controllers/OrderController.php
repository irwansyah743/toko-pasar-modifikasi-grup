<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Pending Orders 
    public function successOrders()
    {
        $admin = Admin::find(Auth::user()->getKey());
        $orderType = "Success";
        $orders = Order::where('status', 'capture')->orWhere('status', 'settlement')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 
    // Pending Orders 
    public function pendingOrders()
    {
        $admin = Admin::find(Auth::user()->getKey());
        $orderType = "Pending";
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 
    // Pending Orders 

    // Pending Orders 
    public function failureOrders()
    {
        $admin = Admin::find(Auth::user()->getKey());
        $orderType = "Failed";
        $orders = Order::where('status', 'failure')->orWhere('status', "cancel")->orWhere('status', "deny")->orWhere('status', "expire")->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 

    public function errorOrders()
    {
        $admin = Admin::find(Auth::user()->getKey());
        $orderType = "Notification Error";
        $orders = Order::where('status', 'to be paid')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 

    // Pending Order Details 
    public function orderDetail(Order $order)
    {
        $admin = Admin::find(Auth::user()->getKey());
        $orderDetail = Order::where('id_pesanan', $order->id_pesanan)->first();
        $orderItem = OrderItem::where('id_pesanan', $order->getKey())->orderBy('id_pesanan_produk', 'DESC')->get();
        return view('back.orders.order_details', compact('orderDetail', 'orderItem', 'admin'));
    } // end method 

    public function updateDelivery(Request $request, Shipping $shipping)
    {
        $validated = $request->validate([
            'resi' => 'required|unique:pengiriman,resi',
        ], [
            'resi.required' => "You have to input the Resi Number before you mark this order as Sent"
        ]);

        $products = OrderItem::where('id_pesanan', $request->id_pesanan)->get();
        foreach ($products as $product) {
            $productData['kuantitas_produk'] = $product->product->kuantitas_produk - $product->kuantitas;
            Product::where('id_produk', $product->product->getKey())->update($productData);
        }

        $validated['resi'] = $request->resi;
        $validated['status_pengiriman'] = 1;
        Shipping::where('id_pengiriman', $shipping->getKey())->update($validated);

        $notification = array(
            'message' => 'Delivery status has been updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}