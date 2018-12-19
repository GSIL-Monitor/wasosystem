<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Request;
use App\Models\User;

use App\Http\Controllers\Controller;
class PersonalDetailsController extends Controller
{
    public $user;
    public function __construct(User $user)
    {
        $this->user= $user;
    }
    //资金管理列表
    public function index(Request $request)
    {
      $user=user();
       return view('member_centers.personal_details.index',compact('user'));
    }
    public function create(Request $request)
    {
        $user=user();

        return view('member_centers.personal_details.password_edit',compact('user'));
    }
    public function update(Request $request)
    {
      if($request->has('password')){
          user()->update(['password'=>bcrypt($request->input('password')),'clear_text'=>encrypt($request->input('password'))]);
          $this->logout();
          return success('密码更新成功,请重新登陆');
      }  else{
          user()->update($request->all());
          return success('个人信息更新成功');
      }
    }
    public function logout()
    {
        request()->session()->flush();
        request()->session()->regenerate();
    }
}