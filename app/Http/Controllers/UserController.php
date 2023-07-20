<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = User::find(Auth::user()->id);
        return view('dashboard', $data);
    }

    public function profile()
    {
        $data['user'] = User::find(Auth::user()->id);
        return view('front.profile.profile', $data);
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
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:20',
            'phone' => 'numeric|nullable',
            'profile_photo_path' => 'image|file|max:2024',
        ]);

        if ($request->file('profile_photo_path')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }

            $validated['profile_photo_path'] = $request->file('profile_photo_path')->store('user-images');
        }

        $validated['name'] = $request->name;
        $validated['email'] = $request->email;
        $validated['phone'] = $request->phone;
        $validated['updated_at'] = Carbon::now();

        User::where('id', $user->id)->update($validated);

        $notification = array(
            'message' => 'Your profile has been updated',
            'alert-type' => 'success'
        );

        return redirect('/user/profile')->with($notification);
    }

    public function editPassword()
    {
        $data['user'] = User::find(Auth::user()->id);;
        return view('front.profile.change_password', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\User  $brand
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();
            $notification = array(
                'message' => 'Your password has been changed',
                'alert-type' => 'success'
            );
            return to_route('login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Your current password is wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function myOrders()
    {
        $data['user'] = User::find(Auth::user()->id);
        $data['orders'] = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();
        return view('front.profile.order', $data);
    }

    public function orderDetails(Order $order)
    {
        $user = User::find(Auth::user()->id);
        $orderDetail = Order::where('order_id', $order->order_id)->where('user_id', Auth::id())->first();
        $orderItem = OrderItem::where('order_id', $order->id)->orderBy('id', 'DESC')->get();
        return view('front.profile.order_detail', compact('orderDetail', 'orderItem', 'user'));
    } // end mehtod

    public function invoiceDownload(Order $order)
    {
        $orderDetail = Order::where('order_id', $order->order_id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('front.profile.transaction_proof', compact('orderDetail', 'orderItems'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('Transaction Proof ' . $order->order_id . '.pdf');
    } // end mehtod
}
