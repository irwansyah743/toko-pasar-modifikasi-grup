<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admin'] = Admin::find(Auth::user()->getKey());
        $data['sliders'] = Slider::latest()->get();
        return view('back.slider.index', $data);
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
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'max:100',
            'gambar_banner' => 'required|image|max:2048',
        ]);

        $image = $request->file('gambar_banner');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1000, 500)->save('storage/sliders/' . $name_gen);
        $save_url = 'sliders/' . $name_gen;

        $validated['judul'] = $request->judul;
        $validated['deskripsi'] = $request->deskripsi;
        $validated['gambar_banner'] = $save_url;
        $validated['created_at'] = Carbon::now();

        // BATCH INSERT
        Slider::create($validated);

        $notification = array(
            'message' => 'A new slider has been added',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $data['slider'] = $slider;
        return view('back.slider.edit', $data);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'judul' => 'max:100',
            'gambar_banner' => 'image|max:2048',
        ]);

        if ($request->file('gambar_banner')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $image = $request->file('gambar_banner');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 500)->save('storage/sliders/' . $name_gen);
            $save_url = 'sliders/' . $name_gen;
            $validated['gambar_banner'] = $save_url;
        }

        $validated['judul'] = $request->judul;
        $validated['deskripsi'] = $request->deskripsi;
        $validated['updated_at'] = Carbon::now();

        // BATCH INSERT
        Slider::where('id_banner', $slider->getKey())->update($validated);

        $notification = array(
            'message' => 'A slider has been updated',
            'alert-type' => 'success'
        );
        return to_route('manage.slider')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {

        if ($slider->slider_image) {
            Storage::delete($slider->gambar_banner);
        }
        Slider::destroy($slider->getKey());
        $notification = array(
            'message' => 'A slider has been deleted',
            'alert-type' => 'success'
        );
        return to_route('manage.slider')->with($notification);
    }

    public function SliderInactive(Slider $slider)
    {
        $slider->update(['status' => 0]);
        $notification = array(
            'message' => 'Slider ' . $slider->judul . ' is Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function SliderActive(Slider $slider)
    {
        $slider->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider ' . $slider->judul . ' is Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
