<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');

        //allows us to login as both user as well as admin at a same time maintaining multiple sessions
        //if guest is only used instead of guest admin, when logged in as user, it won't allow to login to the admin login
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request){
        //Validate the form data
    $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:6'
    ]);

        //Attempt to log the user in
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email', 'remember'));

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');

//        $this->guard('')->logout();
//
//        $request->session()->invalidate();



//        return $this->loggedOut($request) ?: redirect('/');
    }


}
