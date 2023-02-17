<?php

namespace App\Http\Controllers\Nova;

use Inertia\Inertia;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginController extends Controller
{
    //
        /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('nova.guest:'.config('nova.guard'))->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Inertia\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function showLoginForm()
    {
        
        if ($loginPath = config('nova.routes.login', false)) {
            return Inertia::location($loginPath);
        }

        return Inertia::render('Nova.Login', []);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
       
        $redirect = redirect()->intended($this->redirectPath());

        return $request->wantsJson()
            ? new JsonResponse([
                'redirect' => $redirect->getTargetUrl(),
            ], 200)
            : $redirect;
    }


    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            [
                'user_type'=>'admin',
                'user_type'=>'superadmin'
            ]
        );
    }
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        
        return Nova::url(Nova::$initialPath);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
       
        return Auth::guard(config('nova.guard'));
    }
}
