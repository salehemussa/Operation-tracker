<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // This will be the default, but we override it in the authenticated() method
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the default redirection based on the user role.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return string
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('admin')) {
            // Redirect admin to admin dashboard
            return redirect(RouteServiceProvider::ADMIN);
        }

        if ($user->hasRole('operator')) {
            // Redirect operator to operator dashboard
            return redirect(RouteServiceProvider::OPERATOR);
        }

        // Default redirection if user doesn't match any role
        return redirect('/home');
    }
}
