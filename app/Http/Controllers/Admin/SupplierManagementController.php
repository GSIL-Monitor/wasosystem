<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierManagementRequest;
use App\Http\Requests\Request;
use App\Services\SupplierManagementServices;
use App\Models\SupplierManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class SupplierManagementController extends Controller
{
    protected $supplier_management;
    protected $supplier_managementServices;
    public function __construct(SupplierManagement $supplier_management,SupplierManagementServices $supplier_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->supplier_management= $supplier_management;
           $this->supplier_managementServices= $supplier_managementServices;
    }
    //供应商管理列表
    public function index(Request $request)
    {
        $supplier_managements =  $this->supplier_management->with('admins','procurement_plans')->latest()->paginate(20);

       return view('admin.supplier_managements.index',compact('supplier_managements'));

    }
    //供应商管理添加
    public function store(SupplierManagementRequest $request)
    {
        SupplierManagement::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //供应商管理添加页面
    public function create(Request $request)
    {
       return view('admin.supplier_managements.create_and_edit');
    }
  //供应商管理修改页面
    public function edit(SupplierManagement $supplier_management)
    {
        return view('admin.supplier_managements.create_and_edit',compact('supplier_management'));
    }
  //供应商管理修改
    public function update(SupplierManagementRequest $request,  SupplierManagement $supplier_management)
    {
        $supplier_management->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //供应商管理删除
    public function destroy(SupplierManagementRequest $request)
    {
        SupplierManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}