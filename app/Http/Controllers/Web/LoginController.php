<?php

namespace App\Http\Controllers\Web;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected  $redirectTo='/member_center/';

    public function __construct()
    {
        $this->middleware('guest:user',['except'=>[
            'logout','redirectToLogin'
        ]]);
    }

    /**重写登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('site.login.index');
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

    public function checkRule()
    {
        $emailRule= function ($attribute, $value, $fail) {
            $email=User::whereEmail(\request('email'))->first();
            if ($email && $email->grade == 'blocked_account') {
                $fail('邮箱已被禁用！请联系客服人员');
            }

        };
        $phoneRule= function ($attribute, $value, $fail) {
            $phone=User::wherePhone(\request('phone'))->first();
            if ($phone && $phone->grade == 'blocked_account') {
                $fail('手机号已被禁用！请联系客服人员');
            }

        };
        $usernameRule= function ($attribute, $value, $fail) {
            $username=User::whereUsername(\request('username'))->first();
            if ($username && $username->grade == 'blocked_account') {
                $fail('账号已被禁用！请联系客服人员');
            }

        };
        $map=[
            'email'=>['rule'=>[
                'required','email',$emailRule
            ],
                'message'=>[
                'email.email'=>'邮箱格式不正确',
            ]],
            'phone'=>['rule'=>[
                'required','regex:/^1[34578][0-9]{9}$/',$phoneRule
            ],'message'=> [
                'phone.regex'=>'手机号格式不正确',
            ]],
            'username'=>['rule'=>[
                'required','min:3',$usernameRule
            ],'message'=> [
                'username.min'=>'账号最小3位数',
            ]],
        ];
       return $map[$this->username()];
    }

    /**重写验证规则
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {

        $rules=[
            $this->username() => $this->checkRule()['rule'], 'password' => 'required', 'captcha' => 'required|captcha'
        ];
        $message=array_merge([
            $this->username().'.required' => '账号/邮箱/手机号必填',
            'password.required' => '密码必填',
            'captcha.required' => '验证码必填',
            'captcha.captcha' => '验证码错误'
        ],$this->checkRule()['message']);
        $request=request()->merge([$this->username() => $request->input('username')]);
        $this->validate($request, $rules,$message);
    }
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $user=User::findOrFail(auth('user')->user()->id);
        $user->increment('login_count');  //登陆次数加一
        $data=['last_login_time'=>Carbon::createFromDate(),'last_login_ip'=>$request->ip()];
        $user->update($data);  //登陆次数加一
        $this->ReadMessage();
        return $this->authenticated($request, $this->guard()->user())
            ? : redirect()->intended($this->redirectPath());
    }

    public function ReadMessage()
    {
        $notifications=Notification::latest()->get();
        $notifications=$notifications->filter(function ($item){
            $grade=user()->grades->identifying;
            return in_array('all',$item->to_user) || in_array($grade,$item->to_user) || in_array(user()->id,$item->to_user);
        });
        $all_notification_count=$notifications->count();
        if(user()->notification->isEmpty()){
            user()->increment('notification_count',$all_notification_count);
            user()->notification()->attach($notifications->pluck('id'));
        }else{
            $read=user()->notification()->whereState(true)->get();
            $readCount=$read->count();
            $noread=$notifications->diff(user()->notification);
            if(user()->notification->isNotEmpty()){
                user()->notification()->attach($noread->pluck('id'));
            }
            user()->notification_count=$all_notification_count - $readCount;
        }
    }
    public function redirectToLogin()
    {
        if ($this->guard()->user()) {
           return redirect($this->redirectTo);
        }

        return redirect('/login');
    }
    public function guard()
    {
        return auth()->guard('user');
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
