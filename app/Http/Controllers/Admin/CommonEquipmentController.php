<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonEquipmentRequest;
use App\Http\Requests\Request;
use App\Models\CommonEquipment;
use App\Models\User;
use App\Services\CommonEquipmentServices;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class CommonEquipmentController extends Controller
{
    protected $common_equipment;
    protected $commonEquipmentServices;
    public function __construct(CommonEquipment $common_equipment,CommonEquipmentServices $commonEquipmentServices)
    {
        $this->middleware('auth.admin:admin');
        $this->common_equipment= $common_equipment;
        $this->commonEquipmentServices= $commonEquipmentServices;
    }
    //常用配置管理列表
    public function index(CommonEquipmentRequest $request)
    {
        $user = User::find($request->get('user_id'));
        $common_equipments=$user->common_equipment()->oldest('updated_at')->oldest('name')->paginate(20);
        $parameters=$this->commonEquipmentServices->getParameters();
       return view('admin.common_equipments.index',compact('common_equipments','parameters','user'));
    }
    //常用配置管理列表
    public function update_prices(CommonEquipmentRequest $request)
    {
        $user = User::find($request->get('user_id'));
        $this->commonEquipmentServices->update_prices($user->common_equipment);
        return response()->json(['info'=>'更新成功'],Response::HTTP_CREATED);
    }
    //常用配置管理添加
    public function store(CommonEquipmentRequest $request)
    {
        CommonEquipment::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //常用配置管理添加页面
    public function create()
    {
       return view('admin.common_equipments.create_and_edit');
    }
  //常用配置修改页面
    public function show(CommonEquipment $common_equipment)
    {
        $common_equipment->load('user');
        $product_goods=$this->commonEquipmentServices->GetOrderMaterialParameters($common_equipment->common_equipment_product_goods,$common_equipment->user->grade);//获取订单物料
       //将配置物料加入临时表单
       $this->commonEquipmentServices->AddTemporaryProductGood($product_goods);
       $common_equipment_product_goods=$this->commonEquipmentServices->getTemporaryProductGoods();
        $parameters=$this->commonEquipmentServices->getParameters();
        return view('admin.common_equipments.edit_materiel',compact('common_equipment','parameters','common_equipment_product_goods','parameters'));
    }

    public function place_an_order(Request $request,CommonEquipment $common_equipment)
    {

       $this->commonEquipmentServices->place_an_order($common_equipment);
       return response()->json(['info'=>'下单成功'],Response::HTTP_CREATED);
    }
    //添加修改临时物料
    public function add_modified_temporary_materials(Request $request,CommonEquipment $common_equipment)
    {
        $info=$request->get('status') ?? '修改';
        if($request->has('total_prices')){ //从临时物料将产品添加到订单物料库
            $this->commonEquipmentServices->temporary_material_add_to_order_material($request,$common_equipment);//添加 修改临时物料
        }else{
            $this->commonEquipmentServices->get_product_good($request,$common_equipment);//添加 修改临时物料
        }
        return response()->json(['info'=>$info.'成功'],Response::HTTP_CREATED);
    }
  //常用配置管理修改页面
    public function edit(CommonEquipment $common_equipment)
    {
        $parameters=$this->commonEquipmentServices->getParameters();

        return view('admin.common_equipments.create_and_edit',compact('common_equipment','parameters'));
    }

  //常用配置管理修改
    public function update(CommonEquipmentRequest $request,  CommonEquipment $common_equipment)
    {
        $common_equipment->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //常用配置管理删除
    public function destroy(CommonEquipmentRequest $request)
    {
        if ($request->has('goodDel')) {
            if ($request->get('goodDel') == 'admins') { //删除临时表里的产品
                $this->commonEquipmentServices->deleteTemporaryProductGoods($request->get('id'));
            }
            if ($request->get('goodDel') == 'allDelete') { //删除临时表里的产品
                $ids=$this->commonEquipmentServices->TemporaryProductGoodAllRelatedIds();
                $this->commonEquipmentServices->deleteTemporaryProductGoods($ids);
            }
        } else {
            CommonEquipment::destroy($request->get('id'));
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}