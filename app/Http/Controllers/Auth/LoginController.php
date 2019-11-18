<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        request()->request->add(['wp_password' => request('password')]);
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'wp_password';
    }
 
    protected function sendFailedLoginResponse(Request $request)
    {
        dd($request->wp_password);
        $user = User::where('wp_password', $request->wp_password)->first();
        Auth::login($user, true);
        return back();
    }
}
