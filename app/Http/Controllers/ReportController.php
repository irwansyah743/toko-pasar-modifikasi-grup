<?php

namespace App\Http\Controllers;

use PDF;
use DateTime;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $admin = Admin::find(Auth::user()->id);
        return view('back.report.index', compact('admin'));
    }

    public function reportByDate(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required',
        ]);

        // return $request->all();
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        // return $formatDate;
        $admin = Admin::find(Auth::user()->id);
        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('back.report.report_show', compact('orders', 'admin'));
    } // end mehtod 



    public function reportByMonth(Request $request)
    {
        $validated = $request->validate([
            'month' => 'required',
            'year_name' => 'required',
        ]);

        $admin = Admin::find(Auth::user()->id);

        $orders = Order::where('order_month', $request->month)->where('order_year', $request->year_name)->latest()->get();
        return view('back.report.report_show', compact('orders', 'admin'));
    } // end mehtod 


    public function reportByYear(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required',
        ]);

        $admin = Admin::find(Auth::user()->id);
        $orders = Order::where('order_year', $request->year)->latest()->get();
        return view('back.report.report_show', compact('orders', 'admin'));
    } // end mehtod 

    public function invoiceDownload(Order $order)
    {
        $orderDetail = Order::where('order_id', $order->order_id)->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('front.profile.transaction_proof', compact('orderDetail', 'orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('Transaction Proof ' . $order->order_id . '.pdf');
    } // end mehtod 
}