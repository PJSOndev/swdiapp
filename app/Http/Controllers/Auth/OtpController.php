<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $otp = rand(100000, 999999);

        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        Mail::to($user->email)->send(new OtpMail($otp));

        return redirect()->route('otp.form')->with('message', 'OTP sent to your email.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp_code' => 'required']);

        $user = User::where('otp_code', $request->otp_code)
                    ->where('otp_expires_at', '>', now())
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp_code' => 'Invalid or expired OTP.']);
        }

        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        Auth::login($user);

        return redirect('/dashboard')->with('message', 'OTP verified!');
    }
}
