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
        $data['admin'] = Admin::find(Auth::user()->getKey());
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
            'nama_merek' => 'required|max:255|unique:merek,nama_merek',
            'gambar_merek' => 'required|image|file|max:2024',
        ], [
            'nama_merek.required' => 'Please input the brand name',
            'nama_merek.max' => 'Max length is 255 characters',
            'nama_merek.unique' => 'This brand has already been added',
            'gambar_merek.required' => 'Please upload the brand image',
        ]);


        if ($request->file('gambar_merek')) {
            $validated['gambar_merek'] = $request->file('gambar_merek')->store('brand-images');
        }

        $validated['nama_merek'] = $request->nama_merek;
        $validated['slug_merek'] = strtolower(str_replace(' ', '-', $request->nama_merek));
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
        $data['admin'] = Admin::find(Auth::user()->getKey());
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
            'nama_merek' => 'required|max:255',
            'gambar_merek' => 'image|file|max:2024',
        ], [
            'nama_merek.required' => 'Please input the brand name',
            'nama_merek.max' => 'Max length is 255 characters',
        ]);
        if ($request->file('gambar_merek')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $validated['gambar_merek'] = $request->file('gambar_merek')->store('brand-images');
        }

        $validated['nama_merek'] = $request->nama_merek;
        $validated['updated_at'] = Carbon::now();

        Brand::where('id', $brand->getKey())->update($validated);

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

        if ($brand->gambar_merek) {
            Storage::delete($brand->gambar_merek);
        }
        Brand::destroy($brand->getKey());
        $notification = array(
            'message' => 'A brand has been deleted',
            'alert-type' => 'success'
        );
        return to_route('all.brand')->with($notification);
    }
}