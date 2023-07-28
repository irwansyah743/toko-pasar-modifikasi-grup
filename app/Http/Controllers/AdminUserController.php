<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class AdminUserController extends Controller
{
    public function index()
    {
        $admin = Admin::find(Auth::user()->getKey());
        $users = User::latest()->get();
        return view('back.user.index', compact('users', 'admin'));
    }

    public function allAdmin()
    {
        $admin = Admin::find(Auth::user()->getKey());

        $adminuser = Admin::where('type', 2)->latest()->get();
        return view('admin.pages.index', compact('adminuser', 'admin'));
    } // end method 

    public function addAdmin()
    {
        $admin = Admin::find(Auth::user()->getKey());
        return view('admin.pages.create', compact('admin'));
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:20',
            'password' => 'required',
            'phone' => 'numeric|nullable',
            'profile_photo_path' => 'image|file|max:2024',

        ]);

        if ($request->file('profile_photo_path')) {
            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('storage/admin-images/' . $name_gen);
            $save_url = 'admin-images/' . $name_gen;
            $validated['profile_photo_path'] = $save_url;
        }

        $validated['name'] = $request->name;
        $validated['email'] = $request->email;
        $validated['password'] = Hash::make($request->password);
        $validated['phone'] = $request->phone;
        $validated['brand'] = $request->brand;
        $validated['category'] = $request->category;
        $validated['product'] = $request->product;
        $validated['slider'] = $request->slider;
        $validated['coupon'] = $request->coupons;
        $validated['review'] = $request->review;
        $validated['orders'] = $request->orders;
        $validated['report'] = $request->reports;
        $validated['alluser'] = $request->alluser;
        $validated['alladmin'] = $request->adminuserrole;
        $validated['type'] = 2;
        $validated['created_at'] = Carbon::now();

        Admin::create($validated);

        $notification = array(
            'message' => 'New Admin Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // end method 

    public function editAdmin($id)
    {
        $admin = Admin::find(Auth::user()->getKey());
        $adminuser = Admin::findOrFail($id);
        return view('admin.pages.edit', compact('adminuser', 'admin'));
    } // end method 

    public function updateAdmin(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:20',
            'password' => 'required',
            'phone' => 'numeric|nullable',
            'profile_photo_path' => 'image|file|max:2024',

        ]);

        if ($request->file('profile_photo_path')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }

            $image = $request->file('profile_photo_path');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(225, 225)->save('storage/admin-images/' . $name_gen);
            $save_url = 'admin-images/' . $name_gen;
            $validated['profile_photo_path'] = $save_url;
        }

        $validated['name'] = $request->name;
        $validated['email'] = $request->email;
        $validated['password'] = Hash::make($request->password);
        $validated['phone'] = $request->phone;
        $validated['brand'] = $request->brand;
        $validated['category'] = $request->category;
        $validated['product'] = $request->product;
        $validated['slider'] = $request->slider;
        $validated['coupon'] = $request->coupons;
        $validated['review'] = $request->review;
        $validated['orders'] = $request->orders;
        $validated['report'] = $request->reports;
        $validated['alluser'] = $request->alluser;
        $validated['alladmin'] = $request->adminuserrole;
        $validated['type'] = 2;
        $validated['updated_at'] = Carbon::now();

        Admin::where('id', $admin->getKey())->update($validated);

        $notification = array(
            'message' => 'New Admin Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin')->with($notification);
    } // end method 

    public function destroy(Admin $admin)
    {

        if ($admin->profile_photo_path) {
            Storage::delete($admin->profile_photo_path);
        }

        Admin::destroy($admin->getKey());

        $notification = array(
            'message' => 'An admin has been deleted',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }
}