<?php

namespace App\Http\Controllers\Auth;

use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Notifications\SendActivationEmail;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if (!$user->verified) {
            auth()->logout();
            return back()->with('warning', 'Debes confirmar tu cuenta. Verifica tu correo electrónico.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function resendActivation() {
        return view('auth.passwords.resend_activation');
    }

    public function resendActivationMail(Request $request) {
        $user = \App\User::where('email', '=', $request->email)->first();
        if ($user) {
            $user->notify(new SendActivationEmail($user->verifyUser->token));
            return redirect('/login')->with('status', 'Revisa tu correo electrónico y haz clic en el enlace para activar tu cuenta.' );
        } else {
            return back()->with('warning', 'El correo electrónico que has proporcionado no está registrado.' );
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
