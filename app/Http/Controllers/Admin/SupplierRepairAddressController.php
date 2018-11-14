<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierRepairAddressRequest;
use App\Http\Requests\Request;
use App\Models\SupplierManagement;
use App\Services\SupplierRepairAddressServices;
use App\Models\SupplierRepairAddress;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class SupplierRepairAddressController extends Controller
{
    protected $supplier_repair_address;
    protected $supplier_repair_addressServices;
    public function __construct(SupplierRepairAddress $supplier_repair_address,SupplierRepairAddressServices $supplier_repair_addressServices)
    {
        $this->middleware('auth.admin:admin');
        $this->supplier_repair_address= $supplier_repair_address;
           $this->supplier_repair_addressServices= $supplier_repair_addressServices;
    }
    //供应商返修地址列表
    public function index(Request $request)
    {

        $supplier_managements_id=$request->get('id');
        $supplier_management=SupplierManagement::find($supplier_managements_id);

        $supplier_repair_addresses =  $supplier_management->supplier_repair_addresses()->latest()->paginate(20);
       return view('admin.supplier_repair_addresses.index',compact('supplier_repair_addresses','supplier_management'));

    }
    //供应商返修地址添加
    public function store(SupplierRepairAddressRequest $request)
    {
        SupplierRepairAddress::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //供应商返修地址添加页面
    public function create(Request $request)
    {
       return view('admin.supplier_repair_addresses.create_and_edit');
    }
  //供应商返修地址修改页面
    public function edit(SupplierRepairAddress $supplier_repair_address)
    {
        return view('admin.supplier_repair_addresses.create_and_edit',compact('supplier_repair_address'));
    }
  //供应商返修地址修改
    public function update(SupplierRepairAddressRequest $request,  SupplierRepairAddress $supplier_repair_address)
    {
        $supplier_repair_address->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //供应商返修地址删除
    public function destroy(SupplierRepairAddressRequest $request)
    {
        SupplierRepairAddress::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}