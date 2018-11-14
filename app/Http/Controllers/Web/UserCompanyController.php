<?php

namespace App\Http\Controllers\Web;

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
        $this->user_company= $user_company;
    }
    //会员单位管理列表
    public function index(UserCompanyRequest $request)
    {
        $user_companies=user()->user_company()->latest('default')->oldest('number')->get();
        $parameters=$this->getParameters();
       return view('member_centers.user_companies.index',compact('user_companies','parameters'));

    }
    //会员单位管理添加
    public function store(UserCompanyRequest $request)
    {
        if($request->input('id')){
            $user_company=UserCompany::findOrFail($request->input('id'));
            $info=$user_company->update($request->all());
        }else{
          $info=UserCompany::create($request->all());
        }
        return response()->json(['info'=>'保存成功','data'=>$info],Response::HTTP_CREATED);
    }

  //会员单位管理修改页面
    public function edit(UserCompany $user_company)
    {
        return $user_company;
    }
  //会员单位管理修改
    public function update(UserCompanyRequest $request,  UserCompany $user_company)
    {
        \DB::transaction(function () use($user_company){
            $user_company->whereDefault(true)->update(['default'=>false]);
            $user_company->update(['default'=>true]);
        });
        return response()->json(['info'=>'设置成功'],Response::HTTP_CREATED);
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
        $arr['invoice']=MemberStatus::whereType('invoice')->pluck('name','identifying')->toArray();
        return $arr;
    }
}