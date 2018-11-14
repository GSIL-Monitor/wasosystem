<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProcurementPlanRequest;
use App\Http\Requests\Request;
use App\Models\ProductGood;
use App\Models\SupplierManagement;
use App\Services\ProcurementPlanServices;
use App\Models\ProcurementPlan;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class ProcurementPlanController extends Controller
{
    protected $procurement_plan;
    protected $procurement_planServices;
    public function __construct(ProcurementPlan $procurement_plan,ProcurementPlanServices $procurement_planServices)
    {
        $this->middleware('auth.admin:admin');
        $this->procurement_plan= $procurement_plan;
           $this->procurement_planServices= $procurement_planServices;
    }
    //采购计划列表
    public function index(Request $request)
    {
        $status=$request->get('status') ?? 'procurement';
        $procurement_plans =  $this->procurement_plan->Condition($status,$request)->paginate(20);

       return view('admin.procurement_plans.index',compact('procurement_plans','status'));

    }
    //采购计划添加
    public function store(ProcurementPlanRequest $request)
    {
        ProcurementPlan::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //采购计划添加页面
    public function create(Request $request)
    {
        $parameters=$this->procurement_planServices->parameters(23);
        return view('admin.procurement_plans.create_and_edit',compact('parameters'));
    }
    //获取产品
    public function get_goods(Request $request)
    {
        $productId=$request->get('id');
        $goods=collect([]);
        if($productId){
            $goods=ProductGood::whereProductId($productId)->oldest('name')->pluck('name','id');
        }
        $goods->prepend('请选择一个产品', 0);
        return $goods;
    }
  //采购计划修改页面
    public function edit(ProcurementPlan $procurement_plan)
    {
        $parameters=$this->procurement_planServices->parameters($procurement_plan->product_id);

        return view('admin.procurement_plans.create_and_edit',compact('procurement_plan','parameters'));
    }
  //采购计划修改
    public function update(ProcurementPlanRequest $request,  ProcurementPlan $procurement_plan)
    {
        $procurement_plan->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //采购计划删除
    public function destroy(ProcurementPlanRequest $request)
    {
        ProcurementPlan::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}