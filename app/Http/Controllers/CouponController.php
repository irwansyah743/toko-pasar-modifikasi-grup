<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['coupons'] = Coupon::orderBy('id_kupon', 'DESC')->get();
        return view('back.coupon.index', $data);
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
     * @param  \App\Http\Requests\StoreCouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kupon' => 'required',
            'diskon_kupon' => 'required',
            'validitas_kupon' => 'required',
        ]);
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        Coupon::create($validated);

        $notification = array(
            'message' => 'A new coupon has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['coupon'] = $coupon;
        return view('back.coupon.coupon_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'nama_kupon' => 'required',
            'diskon_kupon' => 'required',
            'validitas_kupon' => 'required',
        ]);
        $validated['updated_at'] = Carbon::now();

        Coupon::where('id_kupon', $coupon->getKey())->update($validated);

        $notification = array(
            'message' => 'A coupon has been updated',
            'alert-type' => 'success'
        );

        return to_route('manage.coupon')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        Coupon::destroy($coupon->getKey());
        $notification = array(
            'message' => 'A coupon has been deleted',
            'alert-type' => 'success'
        );
        return to_route('manage.coupon')->with($notification);
    }
}
