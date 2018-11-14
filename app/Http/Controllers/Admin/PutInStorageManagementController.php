<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PutInStorageManagementRequest;
use App\Http\Requests\Request;
use App\Services\PutInStorageManagementServices;
use App\Models\ProcurementPlan;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class PutInStorageManagementController extends Controller
{
    protected $put_in_storage_management;
    protected $put_in_storage_managementServices;
    public function __construct(ProcurementPlan $put_in_storage_management,PutInStorageManagementServices $put_in_storage_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->put_in_storage_management= $put_in_storage_management;
       $this->put_in_storage_managementServices= $put_in_storage_managementServices;
    }
    //入库管理列表
    public function index(Request $request)
    {
        $put_in_storage_managements =  $this->put_in_storage_management->Condition('procurement',$request)->paginate(20);

       return view('admin.put_in_storage_managements.index',compact('put_in_storage_managements'));

    }
    //入库管理入库未完
    public function in_unfinished(Request $request)
    {
        $put_in_storage_managements =  $this->put_in_storage_management->Condition('unfinished',$request)->paginate(20);

        return view('admin.put_in_storage_managements.in_unfinished',compact('put_in_storage_managements'));
    }
    //入库管理已入库
    public function in_finish(Request $request)
    {
        $put_in_storage_managements =  $this->put_in_storage_management->Condition('finish',$request)->paginate(20);

        return view('admin.put_in_storage_managements.in_finish',compact('put_in_storage_managements'));
    }
    //入库管理添加
    public function store(PutInStorageManagementRequest $request)
    {
        $data=$request->all();
        $this->put_in_storage_managementServices->code_in_storage('',$data);
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //入库管理添加页面
    public function create(Request $request)
    {
        $parameters=$this->put_in_storage_managementServices->parameters(23);
       return view('admin.put_in_storage_managements.create',compact('parameters'));
    }

    public function checkCode(Request $request)
    {
        $code=$request->input('code');
        $count=ProcurementPlan::where('code','like',"%$code%")->count();
        return response()->json($count);
    }
  //入库管理修改页面
    public function edit(ProcurementPlan $put_in_storage_management)
    {
        $parameters=$this->put_in_storage_managementServices->parameters($put_in_storage_management->product_id);
        return view('admin.put_in_storage_managements.edit',compact('put_in_storage_management','parameters'));
    }
    //入库管理修改
    public function two_code(PutInStorageManagementRequest $request,  ProcurementPlan $put_in_storage_management)
    {

        $parameters=$this->put_in_storage_managementServices->parameters($put_in_storage_management->product_id);
        return view('admin.put_in_storage_managements.two_code',compact('put_in_storage_management','parameters'));
    }
    //入库管理修改
    public function update(PutInStorageManagementRequest $request,  ProcurementPlan $put_in_storage_management)
    {
        $data=$request->all();
        if($request->has('two_code')){
            $data['two_code']=explode(',',$data['two_code']);
            $put_in_storage_management->update($data);
        }else{
            $this->put_in_storage_managementServices->code_in_storage($put_in_storage_management,$data);
        }

         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //入库管理删除
    public function destroy(PutInStorageManagementRequest $request)
    {
        ProcurementPlan::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}