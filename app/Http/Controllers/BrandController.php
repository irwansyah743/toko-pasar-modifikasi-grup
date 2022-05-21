<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['brands'] = Brand::latest()->get();
        return view('back.brand.index', $data);
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
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|unique:brands|max:255|unique:brands,brand_name',
            'brand_image' => 'required|image|file|max:2024',
        ], [
            'brand_name.required' => 'Please input the brand name',
            'brand_name.max' => 'Max length is 255 characters',
            'brand_name.unique' => 'This brand has already been added',
            'brand_image.required' => 'Please upload the brand image',
        ]);


        if ($request->file('brand_image')) {
            $validated['brand_image'] = $request->file('brand_image')->store('brand-images');
        }

        $validated['brand_name'] = $request->brand_name;
        $validated['brand_slug'] = strtolower(str_replace(' ', '-', $request->brand_name));
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        Brand::create($validated);

        $notification = array(
            'message' => 'A new brand has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        $data['admin'] = Admin::find(Auth::user()->id);
        $data['brand'] = $brand;
        return view('back.brand.brand_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            'brand_name' => 'required|max:255',
            'brand_image' => 'image|file|max:2024',
        ], [
            'brand_name.required' => 'Please input the brand name',
            'brand_name.max' => 'Max length is 255 characters',
        ]);
        if ($request->file('brand_image')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validated['brand_image'] = $request->file('brand_image')->store('brand-images');
        }

        $validated['brand_name'] = $request->brand_name;
        $validated['updated_at'] = Carbon::now();

        Brand::where('id', $brand->id)->update($validated);

        $notification = array(
            'message' => 'A brand has been updated',
            'alert-type' => 'success'
        );

        return to_route('all.brand')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {

        if ($brand->brand_image) {
            Storage::delete($brand->brand_image);
        }
        Brand::destroy($brand->id);
        $notification = array(
            'message' => 'A brand has been deleted',
            'alert-type' => 'success'
        );
        return to_route('all.brand')->with($notification);
    }
}