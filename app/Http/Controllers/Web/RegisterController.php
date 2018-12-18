<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
class RegisterController extends Controller
{





    /**重写登录视图
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

//        dump(\Cache::get('phone_code'),\Cache::get('email_code'));
        return view('site.registers.index');
    }
    public function check(Request $request,$user)
    {

        return view('site.registers.check',compact('user'));
    }

    public function wechat_auth()
    {
        $user = session('wechat.oauth_user.default')->toArray(); // 拿到授权用户资料
        $unionid=session('unionid',$user['original']['unionid']);
        $user=User::where('wechat_openid',$unionid)->first();
        if($user && in_array($user->grade,['blocked_account']) ){
         return redirect()->route('register.check',$user->username);
        }elseif ($user && !in_array($user->grade,['blocked_account'])){
            \Auth::guard('user')->login($user);
            return redirect()->route('member_center');
        }else{
        return redirect()->route('account.setting');
        }
    }
    public function wechat_bind(Request $request)
    {
        $username=$request->username;
        $wechat_user = session('wechat.oauth_user.default')->toArray(); // 拿到授权用户资料
        $user=User::where(function($query) use($username){
            $query->orWhere('email',$username)->orWhere('phone',$username)->orWhere('username',$username);
        })->first();
        $user->wechat_openid=$wechat_user['original']['unionid'];
        $user->save();
        return \Auth::guard('user')->login($user);
    }
    public function wechat_store(Request $request)
    {
        $data=$request->all();
        $user = session('wechat.oauth_user.default')->toArray(); // 拿到授权用户资料
        $data['clear_text']=encrypt($data['password']);
        $data['password']=bcrypt($data['password']);
        $data['username']=$data['username'];
        $data['phone']=$data['phone'];
        $data['wechat_openid']=$user['original']['unionid'];
        $data['nickname']=$user['nickname'];
        $user=User::create($data);
        if($user){
            $data['source']='网站注册';
            $user->visitor_details()->create($data);//修改客情信息
            ding()->at([],true)->with('registered_customer')
                ->text('测试信息！！！！ 有新注册客户！账号：'.$user->username.'，请值班客服人员尽快受理！来源:微信注册'
                );
            return \Auth::guard('user')->login($user);
        }
        return error('错误');
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $data['clear_text']=encrypt($data['password']);
        $data['password']=bcrypt($data['password']);
        $data[$data['type']]= $data['number'];
        $source=$data['type'] =='phone' ? '手机' :'邮箱';
        $user_data=array_except($data,['number','type','_token']);
        $user=User::create($user_data);
        if($user){
            $user_data['source']='网站注册';
            $user->visitor_details()->create($user_data);//修改客情信息
            ding()->at([],true)->with('registered_customer')
                ->text('测试信息！！！！ 有新注册客户！账号：'.$user->username.'，请值班客服人员尽快受理！来源:'.$source.'注册'
                );
            return $user->username;
        }
       return error('错误');
    }

}
