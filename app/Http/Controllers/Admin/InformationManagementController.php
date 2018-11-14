<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InformationManagementRequest;
use App\Http\Requests\Request;
use App\Models\CompleteMachine;
use App\Services\InformationManagementServices;
use App\Models\InformationManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class InformationManagementController extends Controller
{
    protected $information_management;
    protected $information_managementServices;
    public function __construct(InformationManagement $information_management,InformationManagementServices $information_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->information_management= $information_management;
           $this->information_managementServices= $information_managementServices;
    }
    //资讯管理列表
    public function index(Request $request)
    {
        $type=$request->get('type') ?? 'company_dynamic';
        $information_managements =  $this->information_management->whereType($type)->latest()->paginate(20);

       return view('admin.information_managements.index',compact('information_managements','type'));

    }
    //资讯管理添加
    public function store(InformationManagementRequest $request)
    {
       $Information= InformationManagement::create($request->all());
        $Information->information_management_complete_machines()->sync($request->get('complete_machines')); //将临时表的产品关联到整机
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //资讯管理添加页面
    public function create(Request $request)
    {
        $complete_machines=CompleteMachine::latest('name')->pluck('name','id');
        $complete_machine=[];
       return view('admin.information_managements.create_and_edit',compact('complete_machines','complete_machine'));
    }
  //资讯管理修改页面
    public function edit(InformationManagement $information_management)
    {
        $complete_machines=CompleteMachine::latest('name')->pluck('name','id');

        $complete_machine= $information_management->information_management_complete_machines()->pluck('id');

        return view('admin.information_managements.create_and_edit',compact('information_management','complete_machines','complete_machine'));
    }
  //资讯管理修改
    public function update(InformationManagementRequest $request,  InformationManagement $information_management)
    {
        $information_management->update($request->all());
        $information_management->information_management_complete_machines()->sync($request->get('complete_machines')); //将临时表的产品关联到整机
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //资讯管理删除
    public function destroy(InformationManagementRequest $request)
    {
        InformationManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}