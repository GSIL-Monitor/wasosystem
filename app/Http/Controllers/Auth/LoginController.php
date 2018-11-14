<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }
    protected function validateChinaPhoneNumber($number)
    {
        return preg_match('/^1[34578]\d{9}$/', $number);
    }

    public function username()
    {
        $username = request()->get('username');

        $map = [
            'email' => filter_var($username, FILTER_VALIDATE_EMAIL),
            'phone' => $this->validateChinaPhoneNumber($username),
        ];
        $field=key(array_filter($map)) ?? 'username';
        request()->merge([$field => $username]);
        return $field;
    }
    public function guard()
    {
        return auth()->guard('user');
    }
}
