<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCompanyRequest;
use App\Models\MemberStatus;
use App\Models\User;
use App\Models\UserCompany;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class UserCompanyController extends Controller
{
    protected $user_company;
    public function __construct(UserCompany $user_company)
    {
        $this->middleware('auth.admin:admin');
        $this->user_company= $user_company;
    }
    //会员单位管理列表
    public function index(UserCompanyRequest $request)
    {
        $user = User::find($request->get('user_id'));
        $user_companies=$user->user_company()->oldest('number')->paginate(20);
        $parameters=$this->getParameters();
       return view('admin.user_companies.index',compact('user_companies','parameters'));

    }
    //会员单位管理添加
    public function store(UserCompanyRequest $request)
    {
        UserCompany::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //会员单位管理添加页面
    public function create()
    {
        $parameters=$this->getParameters();
       return view('admin.user_companies.create_and_edit',compact('parameters'));
    }
  //会员单位管理修改页面
    public function edit(UserCompany $user_company)
    {
        $parameters=$this->getParameters();
        return view('admin.user_companies.create_and_edit',compact('user_company','parameters'));
    }
  //会员单位管理修改
    public function update(UserCompanyRequest $request,  UserCompany $user_company)
    {
        $user_company->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //会员单位管理删除
    public function destroy(UserCompanyRequest $request)
    {
        UserCompany::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
    //获取参数
    public function getParameters()
    {

        $arr['invoice']=MemberStatus::whereType('invoice')->pluck('name','identifying');
        return $arr;
    }
}