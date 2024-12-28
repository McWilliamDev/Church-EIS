<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/dashboard');
            }
        }
        return view('auth.login');
    }

    public function Authlogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], remember: $remember)) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/dashboard');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    //Forgot Password Function
    public function forgotpassword()
    {
        return view('auth.forgot-password');
    }
    public function PostForgotPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if (!empty($user)) {
            $user->remember_token = Str::random(30);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Password reset link sent to your email");
        } else {
            return redirect()->back()->with('error', "Email Not Found");
        }
    }
    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if (!empty($user)) {
            $data['$user'] = $user;
            return view('auth.reset-password');
        } else {
            return redirect()->back()->with('error', "Invalid Token");
        }
    }

    //Reset Password Function
    public function PostReset($token, Request $request)
    {
        if ($request->password == $request->confirmpassword) {
            $user = User::getTokenSingle($token);
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->remember_token = Str::random(30);
                $user->save();

                return redirect('admin')->with('success', "Password Reset Successfully");
            } else {
                return redirect()->back()->with('error', "Invalid token!");
            }
        } else {
            return redirect()->back()->with('error', "Password and Confirm Password does not match");
        }
    }

    //Logout Function
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(url('/admin'));
    }
}
