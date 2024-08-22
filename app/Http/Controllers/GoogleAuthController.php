<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $google_user->getName(),
                    'email' => $google_user->getEmail(),
                    'google_id' => $google_user->getId()
                ]);

                Auth::login($new_user);

                return redirect()->intended('/dashboard');
            } else {
                Auth::login($user);

                return redirect()->intended('/dashboard');
            }
        } catch (\Throwable $th) {
            dd('Something went wrong: ' . $th->getMessage());
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callbackFacebook()
    {
        try {
            $facebook_user = Socialite::driver('facebook')->user();

            $user = User::where('facebook_id', $facebook_user->getId())->first();

            if (!$user) {
                $new_user = User::create([
                    'name' => $facebook_user->getName(),
                    'email' => $facebook_user->getEmail(),
                    'facebook_id' => $facebook_user->getId()
                ]);

                Auth::login($new_user);

                return redirect()->intended('/dashboard');
            } else {
                Auth::login($user);

                return redirect()->intended('/dashboard');
            }
        } catch (\Throwable $th) {
            dd('Something went wrong: ' . $th->getMessage());
        }
    }

    public function redirectToInstagram()
{
    return Socialite::driver('instagram')->redirect();
}

public function callbackInstagram()
{
    try {
        $instagram_user = Socialite::driver('instagram')->user();

        $user = User::where('instagram_id', $instagram_user->getId())->first();

        if (!$user) {
            $new_user = User::create([
                'name' => $instagram_user->getName(),
                'email' => $instagram_user->getEmail(),
                'instagram_id' => $instagram_user->getId()
            ]);

            Auth::login($new_user);

            return redirect()->intended('/dashboard');
        } else {
            Auth::login($user);

            return redirect()->intended('/dashboard');
        }
    } catch (\Throwable $th) {
        dd('Something went wrong: ' . $th->getMessage());
    }
}

public function redirectToTwitter()
{
    return Socialite::driver('twitter')->redirect();
}

public function callbackTwitter()
{
    try {
        $twitter_user = Socialite::driver('twitter')->user();

        $user = User::where('twitter_id', $twitter_user->getId())->first();

        if (!$user) {
            $new_user = User::create([
                'name' => $twitter_user->getName(),
                'email' => $twitter_user->getEmail(),
                'twitter_id' => $twitter_user->getId()
            ]);

            Auth::login($new_user);

            return redirect()->intended('/dashboard');
        } else {
            Auth::login($user);

            return redirect()->intended('/dashboard');
        }
    } catch (\Throwable $th) {
        dd('Something went wrong: ' . $th->getMessage());
    }
}

}
