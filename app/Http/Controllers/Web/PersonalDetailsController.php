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

        return view('member_centers.personal_details.passwoed_edit',compact('user'));
    }
    public function update(Request $request)
    {
      if($request->has('password')){
          $rules=[
              'old_password' => [
                  'required',
                  'between:6,20',
                  function ($attribute, $value, $fail) {
                      if (request()->input('old_password') != decrypt(user()->clear_text)) {
                          $fail('原密码不正确');
                      }
                      return;
                  }
              ],
              'password' => [
                  'required',
                  'between:6,20',
                  function ($attribute, $value, $fail) {
                      if (request()->input('password_confirmation') != request()->input('password')) {
                          $fail('确认密码 两次输入不一致。');
                      }
                      return;
                  }
              ],
              'password_confirmation' =>  [
                  'required',
                  'between:6,20',
                  function ($attribute, $value, $fail) {
                      if (request()->input('password_confirmation') != request()->input('password')) {
                          $fail('确认密码 两次输入不一致。');
                      }
                      return;
                  }
              ],
          ];
          $message=[
              'old_password.required' => '原密码不能为空',
              'old_password.between' => '原密码位数为6-20位',
              'password.required' => '新密码不能为空',
              'password.between' => '新密码位数为6-20位',
              'password_confirmation.required' => '确认密码不能为空',
              'password_confirmation.between' => '确认密码位数为6-20位',
          ];
          $this->validate($request, $rules,$message);
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