<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Controller;
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
        $data['admin'] = Admin::find(1);
        return view('admin.dashboard', $data);
    }

    public function profile()
    {
        $data['admin'] = Admin::find(1);
        return view('admin.profile', $data);
    }

    public function profileEdit()
    {
        $data['admin'] = Admin::find(1);
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
        // $admin_image = $request->file('brand_image');
        if ($request->file('profile_photo_path')) {
            if ($request->old_image) {
                Storage::delete($request->old_image);
            }
            // $img_gen = hexdec(uniqid()) . '.' . strtolower($admin_image->getClientOriginalExtension());
            // Image::make($admin_image)->resize(300, 200)->save('storage/brand-images/' . $img_gen);
            // $validated['brand_image'] = 'brand-images/' . $img_gen;
            $validated['profile_photo_path'] = $request->file('profile_photo_path')->store('admin-images');
        }

        $validated['name'] = $request->name;
        $validated['email'] = $request->email;
        $validated['updated_at'] = Carbon::now();

        Admin::where('id', $admin->id)->update($validated);

        return to_route('admin.profile')->with('status', "Admin profile has been updated");
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
    public function store(LoginRequest $request)
    {
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