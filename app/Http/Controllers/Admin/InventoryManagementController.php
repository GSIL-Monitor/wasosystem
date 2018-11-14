<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\InventoryManagementRequest;
use App\Http\Requests\Request;
use App\Models\Product;
use App\Services\InventoryManagementServices;
use App\Models\InventoryManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class InventoryManagementController extends Controller
{
    protected $inventory_management;
    protected $inventory_managementServices;
    public function __construct(InventoryManagement $inventory_management,InventoryManagementServices $inventory_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->inventory_management= $inventory_management;
           $this->inventory_managementServices= $inventory_managementServices;
    }
    //库存管理列表
    public function index(Request $request)
    {
        $product_id=$request->get('product_id') ?? 23;
        $products=Product::oldest('bianhao')->pluck('title','id')->toArray();
        $inventory_managements =  $this->inventory_management->with('product_good')->Condition($product_id,$request)->latest()->paginate(20);

       return view('admin.inventory_managements.index',compact('inventory_managements','products','product_id'));

    }
    //库存管理添加
    public function store(InventoryManagementRequest $request)
    {
        InventoryManagement::create($request->all());

        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //库存管理添加页面
    public function create(Request $request)
    {
       return view('admin.inventory_managements.create_and_edit');
    }
  //库存管理修改页面
    public function edit(InventoryManagement $inventory_management)
    {
        return view('admin.inventory_managements.create_and_edit',compact('inventory_management'));
    }
  //库存管理修改
    public function update(InventoryManagementRequest $request,  InventoryManagement $inventory_management)
    {
        $inventory_management->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //库存管理删除
    public function destroy(InventoryManagementRequest $request)
    {
        InventoryManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}