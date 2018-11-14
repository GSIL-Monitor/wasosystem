<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BusinessManagementRequest;
use App\Http\Requests\Request;
use App\Services\BusinessManagementServices;
use App\Models\BusinessManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class BusinessManagementController extends Controller
{
    protected $business_management;
    protected $business_managementServices;
    public function __construct(BusinessManagement $business_management,BusinessManagementServices $business_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->business_management= $business_management;
           $this->business_managementServices= $business_managementServices;
    }
    //企业管理荣誉列表
    public function honor(Request $request)
    {
        $honors =  $this->business_management->whereType('honor')->latest('sort')->paginate(20)?? [];

       return view('admin.business_managements.honor',compact('honors'));

    }
    //企业管理招聘计划列表
    public function job(Request $request)
    {

        $jobs = $this->business_management->whereType('job')->latest()->paginate(20)?? [];
        return view('admin.business_managements.job',compact('jobs'));

    }
    //企业管理服务帮助列表
    public function service_directory(Request $request)
    {
        $service_directorys = $this->business_management->whereType('service_directory')->latest()->paginate(20)?? [];

        return view('admin.business_managements.service_directory',compact('service_directorys'));
    }
    //企业管理焦点图列表
    public function banner(Request $request)
    {
        $banners = $this->business_management->whereType('banner')->latest()->paginate(20)?? [];

        return view('admin.business_managements.banner',compact('banners'));

    }
    //企业管理友情链接列表
    public function friend(Request $request)
    {
        $friends = $this->business_management->whereType('friend')->latest()->paginate(20)?? [];

        return view('admin.business_managements.friend',compact('friends'));

    }
    //企业管理关于我们
    public function about(Request $request)
    {
        $about =  $this->business_management->whereType('about')->first() ?? [];
        return view('admin.business_managements.create_and_edit',compact('about'));
    }
    //企业管理版权声明
    public function copyright(Request $request)
    {
        $copyright =  $this->business_management->whereType('copyright')->first() ?? [];
        return view('admin.business_managements.create_and_edit',compact('copyright'));
    }


    //企业管理添加
    public function store(BusinessManagementRequest $request)
    {
        BusinessManagement::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //企业管理添加页面
    public function create(Request $request)
    {
        $business_management=[];
       return view('admin.business_managements.create_and_edit',compact('business_management'));
    }
  //企业管理修改页面
    public function edit(BusinessManagement $business_management)
    {

        return view('admin.business_managements.create_and_edit',compact('business_management'));
    }
  //企业管理修改
    public function update(BusinessManagementRequest $request,  BusinessManagement $business_management)
    {
        $business_management->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //企业管理删除
    public function destroy(BusinessManagementRequest $request)
    {
        BusinessManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}