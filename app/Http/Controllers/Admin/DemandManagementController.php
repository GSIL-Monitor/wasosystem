<?php

namespace App\Http\Controllers\Admin;

use App\Events\DemandCollaboration;
use App\Http\Requests\DemandManagementRequest;
use App\Http\Requests\Request;
use App\Models\CompleteMachine;
use App\Models\DemandFiltrate;
use App\Models\DemandManagement;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\User;
use App\Models\VisitorDetail;
use App\Services\DemandManagementServices;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Overtrue\Pinyin\Pinyin;
class DemandManagementController extends Controller
{
    protected $demand_management;
    protected $demandManagementServices;
    public function __construct(DemandManagement $demand_management,DemandManagementServices $demandManagementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->demand_management= $demand_management;
        $this->demandManagementServices= $demandManagementServices;
    }
    //需求管理列表
    public function index(DemandManagementRequest $request)
    {
        $cate = $request->get('cate') ?? 'all_demand';
        $select_date=$request->get('select_date');
        $date=$select_date ? explode(' - ',$select_date) : [];
        $demand_managements =  $this->demand_management->Demand($request,$cate)->paginate(20);
        $parameters=$this->demandManagementServices->getParameters();

       return view('admin.demand_managements.index',compact('demand_managements','parameters','cate','date'));

    }


    //需求管理添加
    public function store(DemandManagementRequest $request)
    {
        if($request->has('user_id')){
            $this->demandManagementServices->userCreateVisitorDetailAndUsersAndDemandManagement($request);
        }else{
            $this->demandManagementServices->createVisitorDetailAndUsersAndDemandManagement($request);
        }

        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //需求管理添加页面
    public function create(Request $request)
    {
        $parameters=$this->demandManagementServices->getParameters();
        if($request->has('visitor_details_id')){
            $visitor_details=VisitorDetail::with('user')->find($request->get('visitor_details_id'));
        }else{
            $user=User::with('visitor_details')->find($request->get('user_id'));

        }

        $filtrate=DemandFiltrate::ancestorsAndSelf(43)->flatten();
       return view('admin.demand_managements.create_and_edit',compact('parameters','visitor_details','filtrate','user'));
    }
  //需求管理修改页面
    public function edit(DemandManagement $demand_management)
    {
        $parameters=$this->demandManagementServices->getParameters();
        $demand_management->load('visitor_detail','user');
        $visitor_details=$demand_management->visitor_detail;
        $demand_management_filtrate=$demand_management->demand_management_filtrate;
        $demand_management_order=$demand_management->demand_management_order;
        $filtrate=DemandFiltrate::ancestorsAndSelf(43)->flatten();
        return view('admin.demand_managements.create_and_edit',compact('demand_management','parameters','visitor_details','filtrate','demand_management_filtrate','demand_management_order'));
    }
    //添加初步方案订单
    public function show(DemandManagement $demand_management,Request $request)
    {
        $cate = $request->get('cate') ?? 'parts';
        $demand_management->load('user');
        $order_types = MemberStatus::whereType('order_type')->pluck('name', 'identifying');//去除定制整机
        $order_type=$order_types->except('custom_complete_machine')->toArray();
        $product=$this->demandManagementServices->check_product_type($cate);

        $i=1;$order_type_code=[];
        foreach ($order_types as $k=>$v){
            $order_type_code[$k]=$i++;
            $order_type_code_str[$order_type_code[$k]]=$k;
        }
        if ($request->has('keyword')){
            $code=$this->demandManagementServices->ConfigureCodeTransformation($request->get('keyword'), $demand_management,$cate);//生成配置订单
        }
        $productGoods=$this->demandManagementServices->getTemporaryProductGoods($cate);
        $productGood_prices=$this->demandManagementServices->getTemporaryProductGoodsPrices($productGoods,$demand_management);

        return view('admin.demand_managements.create_cases',compact('productGood_prices','product','demand_management','order_type','code','order_type_code','order_type_code_str','cate','productGoods'));
    }
    //获取整机产品
    public function get_complete_machine(Request $request)
    {
        $pinyin= new Pinyin('Overtrue\Pinyin\MemoryFileDictLoader');
        $name=strtolower($pinyin->permalink($request->get("parent_id"),'_'));
       $complete_machines = CompleteMachine::where('jiagou->'.$name,$request->get("parent_id"))->orderBy('name', 'asc')->get(['id', 'name']);
       return $complete_machines;
    }
    //添加修改临时物料
    public function add_modified_temporary_materials(Request $request,DemandManagement $demand_management)
    {
        $info=$request->get('status') ?? '修改';
        if($request->has('total_prices')){ //从临时物料将产品添加到订单物料库
            $this->demandManagementServices->temporary_material_add_to_order_material($request,$demand_management);//添加 修改临时物料
        }else{
            if($request->has('name')){
                $price_spread=CompleteMachine::whereName($request->get('name'))->first();//获取整机差额
                 return response()->json($price_spread->price['balance'] ?? 0,Response::HTTP_CREATED);
            }else{
                if ($request->has('type')){
                    $this->demandManagementServices->CompleteMachineToTemporaryTable($request, $demand_management);//生成配置订单
                }else{
                    $this->demandManagementServices->get_product_good($request,$demand_management);//添加 修改临时物料
                }
            }

        }
        return response()->json(['info'=>$info.'成功'],Response::HTTP_CREATED);
    }
    //获取筛选参数
    //筛选答案
    public function filtrateList(Request $request)
    {
        $filtrate=DemandFiltrate::find($request->get('id'));

        $nextSiblings=$filtrate->children->pluck('name','id');
        $arr=collect([]);
        if($nextSiblings->isNotEmpty()) { //判断是否有兄弟数据  获取所有兄弟数据  添加自己进数组
            $arr= $nextSiblings->prepend('请选择一项', 0);
        }
        return $arr->toArray();
    }
  //需求管理修改
    public function update(DemandManagementRequest $request,  DemandManagement $demand_management)
    {
        $filtrate=array_only($request->all(),['filtrate']);
       $demand_management->update($request->all());
        $demand_management->demand_management_filtrate()->sync($filtrate['filtrate']);
        event(new DemandCollaboration($demand_management)); //发送钉钉需求协助消息
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //需求管理删除
    public function destroy(DemandManagementRequest $request)
    {
        if($request->has('delOrder')){
            if ($request->get('delOrder') == 'admins') { //删除临时表里的产品
                $this->demandManagementServices->deleteTemporaryProductGoods($request->get('id'),$request->get('cate'));
            }
            if ($request->get('delOrder') == 'allDelete') { //删除临时表里的产品
                Order::destroy($request->get('id'));
            }

        }else{
            DemandManagement::destroy($request->get('id'));
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }

}