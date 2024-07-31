<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Stringable;
use Illuminate\Support\Str;


use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware("guest")->except("logout");
    }

    public function index()
    {
        return view("auth.login");
    }

    public function check(Request $request)
    {

        $request->validate([
            "email" => "required|email",
            "password" => "required|min:2"
        ]);
        $rememberMe  = $request->only("rememberMe");
        $credentials = $request->only("email", "password");

        $isAuth =  Auth::attempt($credentials, $rememberMe);
        if ($isAuth) {

            $request->session()->regenerate();
            return redirect()->intended(route("home"));
        } else {
            return back()->withErrors(["error" => "Invalid credentials"]);
        }
    }


    public function signup()
    {
        return view("auth.signup");
    }


    public function save(Request $request)
    {

        $user = $request->only(['name', 'email', "password"]);

        $res = User::create($user);

        if (!$res) abort('500', "Couldn't sign you up, Please try aggain later.");

        $mailController = new MailController;
        $mailController->mailConfirmation($res);
        // event(new Registered($user));

        Auth::login($res);

        return redirect()->route("home");
    }


    public function passwordrequest()
    {
        return view('auth.forgot-password');
    }
    public function passwordemail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email'
        ]);

        $status = Password::sendResetLink($request->only('email'));
        // dd($status);
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }


    public function passwordreset(Request $request)
    {
        // dd($request->all());

        return view('auth.reset-password',);
    }


    public function passwordupdate(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        // dd($request);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('message', __($status))
            : back()->withErrors(['error' => [__($status)]]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
