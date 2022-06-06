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
        $data['admin'] = Admin::find(Auth::user()->id);
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
            'title' => 'max:100',
            'slider_img' => 'required|image|max:2048',
        ]);

        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1000, 500)->save('storage/sliders/' . $name_gen);
        $save_url = 'sliders/' . $name_gen;

        $validated['title'] = $request->title;
        $validated['description'] = $request->description;
        $validated['slider_img'] = $save_url;
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
            'title' => 'max:100',
            'slider_img' => 'image|max:2048',
        ]);

        if ($request->file('slider_img')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            $image = $request->file('slider_img');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1000, 500)->save('storage/sliders/' . $name_gen);
            $save_url = 'sliders/' . $name_gen;
            $validated['slider_img'] = $save_url;
        }

        $validated['title'] = $request->title;
        $validated['description'] = $request->description;
        $validated['updated_at'] = Carbon::now();

        // BATCH INSERT
        Slider::where('id', $slider->id)->update($validated);

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
            Storage::delete($slider->slider_img);
        }
        Slider::destroy($slider->id);
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
            'message' => 'Slider ' . $slider->title . ' is Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function SliderActive(Slider $slider)
    {
        $slider->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider ' . $slider->title . ' is Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}