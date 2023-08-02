<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['supliers'] = Suplier::latest()->get();
        return view('back.suplier.index', $data);
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
            'nama_suplier' => 'required|max:255|unique:suplier,nama_suplier',
            'alamat_suplier' => 'required'
        ], [
            'nama_suplier.required' => 'Mohon memasukkan nama suplier',
            'nama_suplier.max' => 'Max length is 255 characters',
            'nama_suplier.unique' => 'This suplier has already been added',
            'alamat_suplier.required' => 'Mohon memasukkan alamat suplier',
        ]);

        $validated['nama_suplier'] = $request->nama_suplier;
        $validated['alamat_suplier'] = $request->alamat_suplier;
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        Suplier::create($validated);

        $notification = array(
            'message' => 'Suplier baru berhasil ditambahkan.',
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
    public function show(Suplier $suplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Suplier $suplier)
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['suplier'] = $suplier;
        return view('back.suplier.suplier_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suplier $suplier)
    {
        $validated = $request->validate([
            'nama_suplier' => 'required|max:255',
            'alamat_suplier' => 'required'
        ], [
            'nama_suplier.required' => 'Mohon memasukkan nama suplier',
            'nama_suplier.max' => 'Max length is 255 characters',
            'alamat_suplier.required' => 'Mohon memasukkan alamat suplier',
        ]);

        $validated['nama_suplier'] = $request->nama_suplier;
        $validated['alamat_suplier'] = $request->alamat_suplier;
        $validated['pengajuan_stok'] = $request->pengajuan_stok;
        $validated['created_at'] = Carbon::now();

        Suplier::where('id_suplier', $suplier->getKey())->update($validated);

        $notification = array(
            'message' => 'Suplier berhasil di update',
            'alert-type' => 'success'
        );

        return to_route('all.suplier')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suplier $suplier)
    {
        Suplier::destroy($suplier->getKey());
        $notification = array(
            'message' => 'Suplier has been deleted',
            'alert-type' => 'success'
        );
        return to_route('all.suplier')->with($notification);
    }
}

