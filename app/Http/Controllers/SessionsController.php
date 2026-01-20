<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Mail\OtpMail;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
{
    $attributes = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (!Auth::attempt($attributes)) {
        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);
    }

    // Generate OTP
    $otp = rand(100000, 999999);
    $user = Auth::user();
    $user->otp_code = $otp;
    $user->otp_expires_at = now()->addMinutes(5);
    $user->save();

    // Send OTP email
    Mail::to($user->email)->send(new OtpMail($otp));

    // Temporarily log out until OTP is verified
    Auth::logout();
    Session::put('otp_user_id', $user->id);

    return redirect()->route('otp.verify.view')->with('status', 'OTP sent to your email.');
}

    public function showOtpForm()
    {
        return view('otp.verify');
    }

    public function verifyOtp(Request $request)
{
    $request->validate([
        'otp' => 'required|digits:6',
    ]);

    $userId = Session::get('otp_user_id');
    $user = User::find($userId);

    if (!$user || $user->otp_code !== $request->otp || now()->greaterThan($user->otp_expires_at)) {
        return back()->withErrors(['otp' => 'Invalid or expired OTP.']);
    }

    // Clear OTP
    $user->otp_code = null;
    $user->otp_expires_at = null;
    $user->save();

    // Log in the user
    Auth::login($user);
    Session::forget('otp_user_id');

    return redirect('/dashboard');
}

    public function showResetForm()
    {
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(request()->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function updateReset()
    {
        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function show(){
        request()->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    }

    public function update(){

        request()->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            request()->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => ($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    public function destroy()
    {
        auth()->logout();
        return redirect('/sign-in');
    }
}
