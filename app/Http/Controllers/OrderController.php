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
    public function captureOrders()
    {
        $admin = Admin::find(Auth::user()->id);
        $orderType = "Capture";
        $orders = Order::where('status', 'capture')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 
    // Pending Orders 
    public function pendingOrders()
    {
        $admin = Admin::find(Auth::user()->id);
        $orderType = "Pending";
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 
    // Pending Orders 
    public function settlementOrders()
    {
        $admin = Admin::find(Auth::user()->id);
        $orderType = "Settlement";
        $orders = Order::where('status', 'settlement')->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 

    // Pending Orders 
    public function failureOrders()
    {
        $admin = Admin::find(Auth::user()->id);
        $orderType = "Failed";
        $orders = Order::where('status', 'failure')->orWhere('status', "cancel")->orWhere('status', "deny")->orderBy('id', 'DESC')->get();
        return view('back.orders.orders', compact('orders', 'orderType', 'admin'));
    } // end mehtod 

    // Pending Order Details 
    public function orderDetail(Order $order)
    {
        $admin = Admin::find(Auth::user()->id);
        $orderDetail = Order::where('order_id', $order->order_id)->first();
        $orderItem = OrderItem::where('order_id', $order->id)->orderBy('id', 'DESC')->get();
        return view('back.orders.order_details', compact('orderDetail', 'orderItem', 'admin'));
    } // end method 

    public function updateDelivery(Request $request, Shipping $shipping)
    {
        $validated = $request->validate([
            'resi' => 'required|unique:shippings,resi',
        ], [
            'resi.required' => "You have to input the Resi Number before you mark this order as Sent"
        ]);

        $products = OrderItem::where('order_id', $request->order_id)->get();
        foreach ($products as $product) {
            $productData['product_qty'] = $product->product->product_qty - $product->qty;
            Product::where('id', $product->product->id)->update($productData);
        }

        $validated['resi'] = $request->resi;
        $validated['delivery_status'] = 1;
        Shipping::where('id', $shipping->id)->update($validated);

        $notification = array(
            'message' => 'Delivery status has been updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}