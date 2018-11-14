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
    public function store(Request $request)
    {

        $data=$request->all();
        $data['clear_text']=encrypt($data['password']);
        $data['password']=bcrypt($data['password']);
        $data[$data['type']]= $data['number'];
        $user_data=array_except($data,['number','type','_token']);
        $user=User::create($user_data);
        if($user){
            $user_data['source']='网站注册';
            $user->visitor_details()->create($user_data);//修改客情信息
            ding()->at([],true)->with('registered_customer')
                ->text('测试信息！！！！ 有新注册客户！账号：'.$user->username.'，请值班客服人员尽快受理！'
                );
            return $user->username;
        }
       return error('错误');
    }

}
