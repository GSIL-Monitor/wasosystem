<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Admin;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected  $redirectTo='/waso/';

    public function __construct()
    {
        $this->middleware('guest:admin',['except'=>[
            'logout','redirectToLogin'
        ]]);
    }

    /**重写登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login.index');
    }
    public function username()
    {
        return 'account';
    }

    /**重写验证规则
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $rules=[
            $this->username() =>[
                'required',
                'max:3',
                function ($attribute, $value, $fail) {
                        $admin=Admin::whereAccount(\request('account'))->first();
                        if ($admin && $admin->disabled == 1) {
                            $fail('账号已被禁用！请联系管理员');
                        }
                }
            ]
            , 'password' => 'required', 'captcha' => 'required|captcha'
        ];
        $message=[
            $this->username().'.required' => '账号必填',
            $this->username().'.max'=>'账号最多3位数',
            'password.required' => '密码必填',
            'captcha.required' => '验证码必填',
            'captcha.captcha' => '验证码错误'
        ];
        $this->validate($request, $rules,$message);
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $admin=Admin::findOrFail(auth('admin')->user()->id);
        $admin->increment('login_count');  //登陆次数加一
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }
    public function redirectToLogin()
    {
        if ($this->guard()->user()) {
           return redirect('/waso/');
        }

        return redirect('/waso/login');
    }
    public function guard()
    {
        return auth()->guard('admin');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
