<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SelfAuthController extends Controller
{
    public function getEasyWechatSession()
    {
        $user = session('wechat.oauth_user.default');
        return $user;
    }
    public function autoLogin()
    {
        $userInfo = $this->getEasyWechatSession();
        $openId = $userInfo['id'];
        //查看对应的openid是否已被注册
        $userModel = User::where('wechat_openid', $openId)->first();
        //如果未注册，跳转到注册
        if (!$userModel) {
            return redirect()->route('register');
        } else {
            //如果已被注册，通过openid进行自动认证，
            //认证通过后重定向回原来的路由，这样就实现了自动登陆。
            if(Auth::attempt(['openid' => $openId, 'password' => '123456'])) {
                return redirect()->intended();
            }
        }
    }

    public function autoRegister()
    {
        $userInfo = $this->getEasyWechatSession();
    //根据微信信息注册用户。
        $userData = [
            'password' => bcrypt('123456'),
            'openid' => $userInfo['id'],
            'nickname' => $userInfo['nickname'],
        ];
        //注意批量写入需要把相应的字段写入User中的$fillable属性数组中
        User::create($userData);
        return redirect()->route('login');
    }
  
}
