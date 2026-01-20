<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $google = Socialite::driver('google')->user();

        // 1: Get email from Google's callback
        $email = $google->getEmail();

        // 2: Check if email exists in the database users table
        $user = User::where('email', $email)->first();
        if (!$user) {
            // 2.1: If does not exist, return not found
            return redirect('sign-in')->withErrors(['email' => 'Email not found']);
        }

        // 3: Update name and email_verified
        $user->name = $google->getName();
        $user->email_verified_at = Carbon::today()->timestamp;
        $user->save();

        // 4: Authenticate login
        Auth::login($user);

        // 5: Redirect to dashboard
        return redirect('/dashboard');

    }
}
