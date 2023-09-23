<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function username()
    {
        return User::USERNAME_FIELD;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function handleGoogleCallback()
    {
        try {
            //create a user using socialite driver google
            $user = Socialite::driver('google')->user();
            // if the user exits, use that user and login
            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {
                if ($finduser->google_id == "") {
                    $finduser->google_id = $user->id;
                    $finduser->save();
                } 
                Auth::login($finduser);
                return redirect('/home');

            } else {
                return redirect('/login')->with('info', 'Para iniciar sesión con una cuenta de Google tiene que estar registrado');
            }
        } catch (\Exception  $e) {
            return redirect('/login')->with('error', 'Hubo un error al iniciar sesión con Google');
        }
    }
}
