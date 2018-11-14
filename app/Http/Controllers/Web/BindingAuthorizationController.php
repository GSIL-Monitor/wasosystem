<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Request;
use App\Mail\BindEmailMail;
use App\Models\User;
use App\Services\MessageSendServices;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class BindingAuthorizationController extends Controller
{
    protected $message_send;
    public $arr=['email'=>'邮箱','phone'=>'手机号'];
    /**
     * OrderSendNotification constructor.
     * @param MessageSendServices $messageSendServices
     */
    public function __construct(MessageSendServices $messageSendServices)
    {
        $this->message_send = $messageSendServices;
    }

    public function index(Request $request)
    {
        return view('member_centers.binding_authorizations.index');

    }

    public function send(Request $request)
    {
        $number = $request->input('number');
        if (str_contains($number, '@')) {
            return \Mail::to($request->input('number'))->queue(new BindEmailMail());
        } else {
            $code =rand(100000,999999);
            cache(['phone_code' => $code], config('app.expiresAt'));
            $msg='您好！手机验证码为:'.$code.'  欢迎您加入网烁会员系统！我们将竭诚为您提供及时、周到的售前售后服务！';
            return $this->message_send->MessageSend($number, $msg);
        }
    }

    public function checkCode(Request $request)
    {
        $code_name = $request->input('code_name');
        $code = $request->input('code');
        $check = $this->message_send->checkCode($code_name, $code);
        if ($check == 'overdue') return error('验证码已经过期！请重新发送验证码');
        return $check == 'success' ? success('验证成功！') : error('验证码不正确！');
    }

    public function checkNumber(Request $request)
    {
        $number = $request->input('number');
        $user=User::where(function($query) use($number){
            $query->orWhere('email',$number)->orWhere('phone',$number)->orWhere('username',$number);
        })->first();
        if (!$user) {
            return success('可以绑定');
        }else{
            return error('已存在');
        }

    }

    public function bind(Request $request)
    {
        $type = $request->input('type');
        $number = $request->input('number');
        $code_name = $request->input('code_name');
        $code = $request->input('code');
        $check = $this->message_send->checkCode($code_name, $code);
        if ($check == 'overdue') return error('验证码已经过期！请重新发送验证码');
        if ($check == 'success') {
            if (User::whereId(user()->id)->update([$type => $number])) {
                return success('绑定成功！');
            } else {
                return error('绑定失败！');
            }
        } else {
                return  error('验证码不正确！');
        }

    }
}