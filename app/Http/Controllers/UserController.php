<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['user'] = User::find(Auth::user()->id);;
        return view('dashboard', $data);
    }

    public function profile()
    {
        $data['user'] = User::find(Auth::user()->id);;
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

        return redirect('/user/profile/' . $user->id)->with($notification);
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
}