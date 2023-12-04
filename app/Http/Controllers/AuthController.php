<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{


    public function redirectToGoogle()

    {

        return Socialite::driver('google')->redirect();

    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->getId())->first();

            if ($finduser) {



                auth()->login($finduser);



            } else {
                $newUser = User::create([
                     'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id

                ]);

                auth()->login($newUser);
             }

            return redirect('/token'); // Redirect to the home page or any desired URL after successful login
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to authenticate with Google'], 500);
        }
    }





    public function logout(){
        Auth::logout();

        return redirect()->back();
    }

    public function token(){
        $user = User::where('id',Auth::user()->id)->first();
        $token = $user->createToken('google')->plainTextToken;
        $user->remember_token = $token;
        $user->save();
 
       return redirect('/');
    }


}
