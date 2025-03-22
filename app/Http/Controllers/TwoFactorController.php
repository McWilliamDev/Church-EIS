<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\TwoFactorMail;
use Illuminate\Support\Facades\Mail;

class TwoFactorController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if (!$user->two_factor_code || now()->isAfter($user->two_factor_expires_at)) {
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = now()->addMinutes(3);
            $user->save();

            // Pass both user and code
            Mail::to($user->email)->send(new TwoFactorMail($user, $code));
        }

        return view('auth.two-factor', [
            'expiryTimestamp' => strtotime($user->two_factor_expires_at)
        ]);
    }

    public function resend(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if (now()->isAfter($user->two_factor_expires_at)) {
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = now()->addMinutes(3);
            $user->save();

            // Pass both user and code to the Mailable class
            Mail::to($user->email)->send(new TwoFactorMail($user, $code));

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Code cannot be resent yet.']);
    }



    public function verify(Request $request)
    {

        $user = Auth::user();
        if ($request->code == $user->two_factor_code && now()->isBefore($user->two_factor_expires_at)) {
            session(['two_factor_authenticated' => true]);

            /** @var User $user */
            $user->two_factor_code = null;
            $user->two_factor_expires_at = null; // Clear expiration time
            $user->save();

            if ($user->user_type == 'admin') {
                return redirect('admin/dashboard');
            } elseif ($user->user_type == 'user') {
                return redirect('user/dashboard');
            }
        }

        return redirect()->route('two-factor.index')->with(['error' => 'The provided code is incorrect or has expired. Please try again']);
    }
}
