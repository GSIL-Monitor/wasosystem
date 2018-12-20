<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\MemberStatus;
use App\Models\User;
use App\Models\Admin;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->middleware('auth.admin:admin');
        $this->user= $user;
    }
    //会员管理列表
    public function index(UserRequest $request)
    {
        $status = $request->get('status') ?? 'VerifiedUser';
        switch ($status) {
            case 'Unverified': {

                $users =  $this->user->Unverified()->paginate(20);
                break;
            }
            case 'BlockedAccount': {
                $users = $this->user->BlockedAccount()->paginate(20);
                break;
            }
            default : {

                $users = $this->user->VerifiedUser($request)->paginate(20);
            }
        }

       return view('admin.users.index',compact('users', 'status'));

    }
    //会员管理添加
    public function store(UserRequest $request)
    {
        $data=$request->all();
        $password=$request->get('password');
        if(!empty($password)){
            $data['password']=bcrypt($password);
            $data['clear_text']=encrypt($password);
        }
        $this->user->create($data);
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //会员管理添加页面
    public function create()
    {
        $parameters=$this->getParameters();
       return view('admin.users.create_and_edit',compact('parameters'));
    }
  //会员管理修改页面
    public function edit(User $user)
    {
        $parameters=$this->getParameters();
        return view('admin.users.create_and_edit',compact('user','parameters'));
    }
  //会员管理修改
    public function update(UserRequest $request,  User $user)
    {
        $data=$request->all();

        $password=$request->get('password');
        if(!empty($password)){
            $data['password']=bcrypt($password);
            $data['clear_text']=encrypt($password);
        }else{
            unset($data['password']);
        }
        $user->update($data);
        $user->visitor_details()->update($request->only(["nickname",
                                                        "industry",
                                                        "address",
                                                        "phone",
                                                        "email",
                                                        "wechat",
                                                        "qq"
                                                        ]));//修改客情信息
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //会员管理删除
    public function destroy(UserRequest $request)
    {
        $users=User::whereIn('id',$request->get('id'))->get();
        foreach ($users as $item){
            $item->delete();
            $item->visitor_details()->delete();//删除记录
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }
    //获取参数
    public function getParameters()
    {
        $arr['admins']=Admin::pluck('name','id');
        $arr['grades']=MemberStatus::whereType('grade')->pluck('name','identifying');
        $arr['tax_rate']=MemberStatus::whereType('tax_rate')->pluck('identifying','id');
        $arr['message_type']=config('status.userInfo');
        foreach (config('status.userIndustry') as $key=>$value){
            foreach ($value as $v){
                $arr['industry'][$key][$v]=$v;
            }
        }
        return $arr;
    }
}