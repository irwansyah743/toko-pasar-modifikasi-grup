<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Responses\LoginResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;
use App\Actions\Fortify\AttemptToAuthenticate;

use App\Http\Responses\LogoutResponseRedirect;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;

class AdminController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function loginForm()
    {
        $data['guard'] = 'admin';
        return view('auth.admin-login', $data);
    }

    public function dashboard()
    {
        $data['admin'] = Admin::find(Auth::user()->id);;
        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $data['admin'] = Admin::find(Auth::user()->id);;
        return view('admin.profile', $data);
    }

    public function profileEdit()
    {
        $data['admin'] = Admin::find(Auth::user()->id);;
        return view('admin.profile-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Admin  $brand
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'required|max:20',
            'email' => 'required|email|max:20',
            'profile_photo_path' => 'image|file|max:2024',
        ]);

        if ($request->file('profile_photo_path')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }

            $validated['profile_photo_path'] = $request->file('profile_photo_path')->store('admin-images');
        }

        $validated['name'] = $request->name;
        $validated['email'] = $request->email;
        $validated['updated_at'] = Carbon::now();

        Admin::where('id', $admin->id)->update($validated);

        $notification = array(
            'message' => 'Your profile has been updated',
            'alert-type' => 'success'
        );

        return redirect('/admin/profile')->with($notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Admin  $brand
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request, Admin $admin)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check($request->current_password, $admin->password)) {
            $admin->password = Hash::make($request->password);
            $admin->save();
            Auth::logout();
            $notification = array(
                'message' => 'Your password has been changed',
                'alert-type' => 'success'
            );
            return to_route('admin.login')->with($notification);
        } else {
            $notification = array(
                'message' => 'Your current password is wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email|exists:App\Models\Admin,email',
            'password' => 'required',
        ]);
    }



    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        $this->login($request);
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponseRedirect::class);
    }
}