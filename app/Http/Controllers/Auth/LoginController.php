<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->role_id == 1 && $user->status == 0) {
        // Redirect admin with not active status to home page with status message
        return redirect('/home')->with('status', 'Wait for approval from the admin.');
    } elseif ($user->role_id == 2 && $user->status == 0) {
        // Redirect student with not active status to home page with status message
        return redirect('/home')->with('status', 'Wait for admin approval.');
    } else {
        // Redirect user to their respective dashboard based on the role
        // Modify the URLs as per your application's routing structure
        switch ($user->role_id) {
            case 1: // Admin
                return redirect('/admin/adminDashboard')->with('status', 'Welcome to Admin Dashboard');
            case 2: // Student
                return redirect('/student/studentDashboard')->with('status', 'Welcome to Student Dashboard');
            // Add more cases for other roles, if needed
        }
    }
}

}
