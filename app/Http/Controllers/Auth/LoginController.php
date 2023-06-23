<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    public function showLoginForm()
    {
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            if (Auth::user()->role == 1 || Auth::user()->role == 0) {
                return redirect()->intended('/admin/dashboard');
            } elseif (Auth::user()->role == 2) {
                return redirect()->intended('/');
            }
        } else {
            return redirect()->route('login.form')->with('fail', 'Email hoặc mật khẩu không chính xác');
        }

    }

    public function logout()
    {
        Auth::logout();
        Cart::destroy();
        return redirect()->route('frontend.home.index');
    }

    public function getUrl()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginCallback()
    {
        $getInfo = Socialite::driver('google')->user();

        $user = $this->createUser($getInfo);

        auth()->login($user);

        return redirect()->to('/');
    }

    function createUser($getInfo)
    {

        $user = User::where('email', $getInfo->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'role' => 2,
                'is_protected' => 0,
                'google_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
