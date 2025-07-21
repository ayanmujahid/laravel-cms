<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{


    public function signin(Request $request)
    {
        // Logic for the sign-in page
        return view('signin')->with('title', 'Sign In'); // Assuming you have a signin.blade.php view
    }

    public function signup(Request $request)
    {
        // Logic for the sign-up page
        return view('signup')->with('title', 'Sign Up'); // Assuming you have a signup.blade.php view
    }
    //
    // public function signInSubmit(Request $request)
    //  {
    //     $validator = $request->validate([
    //         'login_email' => 'required|email|max:255',
    //         'login_password' => 'required|max:50',
    //     ]);
    
    //     $current_user = User::where("email", $request->login_email)->first();
    
    //     if ($current_user) {
    //         if ($current_user->verified_user == 1) {
    //             // Attempt to authenticate the user
    //             if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
    //                 // User is verified and authenticated, proceed to home
    //                 return redirect()->route('home')->with('notify_success', 'Logged In!');
    //             } else {
    //                 // Authentication failed, invalid credentials
    //                 return back()->with('notify_error', 'Invalid Credentials');
    //             }
    //         } else {
    //             // User is not verified, redirect to verification page with user_id
    //             $user_id = encrypt($current_user->id);
    //             return redirect()->route('user_verification', $user_id)->with('notify_error', 'Please verify your account.');
    //         }
    //     } else {
    //         // User not found, redirect to signup
    //         return redirect()->route('signup')->with('notify_error', 'Sign up Your account first.');
    //     }
    // }

    public function signInSubmit(Request $request)
{
    $request->validate([
        'login_email' => 'required|email|max:255',
        'login_password' => 'required|max:50',
    ]);

    $current_user = User::where("email", $request->login_email)->first();

    if ($current_user) {
        // Attempt to authenticate the user without checking verification
        if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
            return redirect()->route('home')->with('notify_success', 'Logged In!');
        } else {
            return back()->with('notify_error', 'Invalid Credentials');
        }
    } else {
        return redirect()->route('signup')->with('notify_error', 'Sign up Your account first.');
    }
}


    public function signUpSubmit(Request $request)
 {
        $validator = $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'sign_up_password' => 'required',
            
        ]);

        $user = User::create([
            'name' => $request['full_name'],
            'email' => $request['email'],
            // 'password' => bcrypt($request['password']),
            'password' => bcrypt($request['sign_up_password']),
        ]);
        Auth::login($user);
        return redirect()->route('home')->with('notify_success', 'Signup successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('signin')->with('notify_success', 'Logged out successfully');
    }
}
