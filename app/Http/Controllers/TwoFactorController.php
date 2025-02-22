<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();
        $code = rand(100000, 999999);
        $user->two_factor_code = $code;
        $user->save();

        Mail::raw("Your two-factor code is $code", function ($message) use ($user) {
            $message->to($user->email)->subject('Two-Factor Code');
        });
        return view('auth.two-factor');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|integer',
        ]);

        $user = Auth::user();
        if ($request->code == $user->two_factor_code) {
            session(['two_factor_authenticated' => true]);

            // Clear the code after successful verification
            /** @var User $user */
            $user->two_factor_code = null;
            $user->save();

            if ($user->user_type == 'admin') {
                return redirect('admin/dashboard');
            } elseif ($user->user_type == 'user') {
                return redirect('user/dashboard');
            }
        }

        return redirect()->route('two-factor.index')->with(['error' => 'The provided code is incorrect']);
    }
}
