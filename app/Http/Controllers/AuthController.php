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
        // Redirect to the appropriate dashboard if already authenticated
        if (Auth::check()) {
            return $this->redirectToDashboard(Auth::user());
        }
        return view('auth.login');
    }

    public function Authlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = !empty($request->remember);

        // Attempt to authenticate the user with the additional condition for is_delete
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_delete' => 0], $remember)) {
            $user = Auth::user();

            // Check if the user needs to go through two-factor authentication
            if ($user->user_type == 'admin' || $user->user_type == 'user') {
                // Redirect to two-factor authentication
                return redirect()->route('two-factor.index')->with('success', 'Your authentication code has been sent to your email');
            }

            // If no 2FA is required, redirect to the dashboard directly
            return $this->redirectToDashboard($user);
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }
    private function redirectToDashboard($user)
    {
        if ($user->user_type == 'admin') {
            return redirect('admin/dashboard');
        } else if ($user->user_type == 'user') {
            return redirect('user/dashboard');
        }
    }

    //Forgot Password Function
    public function forgotpassword()
    {
        return view('auth.forgot-password');
    }
    public function PostForgotPassword(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Retrieve the user by email, ensuring to check if they are not deleted
        $user = User::where('email', $request->email)->where('is_delete', 0)->first();

        if (!empty($user)) {
            // Generate a random token for password reset
            $user->remember_token = Str::random(30);
            $user->save();

            // Send the password reset email
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
            $data['user'] = $user; // Corrected variable name
            return view('auth.reset-password', $data);
        } else {
            return redirect()->back()->with('error', "Invalid Token");
        }
    }

    // Reset Password Function
    public function PostReset($token, Request $request)
    {
        // Define password validation rules
        $rules = [
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/|regex:/[@$!%*?&]/',
            'confirmpassword' => 'required|string|same:password',
        ];

        // Validate the request
        $request->validate($rules);

        $user = User::getTokenSingle($token);
        if ($user) {
            // Check if the new password is the same as the old password
            if (Hash::check($request->password, $user->password)) {
                return redirect()->back()->with('error', "New password cannot be the same as the old password.");
            }

            // Update the password
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('admin')->with('success', "Password Reset Successfully");
        } else {
            return redirect()->back()->with('error', "Invalid token!");
        }
    }

    //Logout Function
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear two-factor authentication session variable
        $request->session()->forget('two_factor_authenticated');

        return redirect('/admin');
    }
}
