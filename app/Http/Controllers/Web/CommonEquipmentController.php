<?php

namespace App\Http\Controllers\Web;

use App\Exports\BaseSheetExport;
use App\Http\Requests\CommonEquipmentRequest;
use App\Http\Requests\Request;
use App\Models\CommonEquipment;
use App\Models\Order;
use App\Models\User;
use App\Services\CommonEquipmentServices;
use App\Services\CompleteMachineServices;
use App\Services\machineServices;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class CommonEquipmentController extends Controller
{
    protected $common_equipment;
    protected $commonEquipmentServices;
    protected $machineServices;
    public function __construct(CommonEquipment $common_equipment,CommonEquipmentServices $commonEquipmentServices,CompleteMachineServices $machineServices)
    {
        $this->common_equipment= $common_equipment;
        $this->commonEquipmentServices= $commonEquipmentServices;
        $this->machineServices= $machineServices;
    }
    //常用配置管理列表
    public function index(CommonEquipmentRequest $request)
    {
        $common_equipments=user()->common_equipment()->latest('updated_at')->latest('name')->paginate(20);
        $parameters=$this->commonEquipmentServices->getParameters();
       return view('member_centers.common_equipments.index',compact('common_equipments','parameters','user'));
    }
    //常用配置管理列表
    public function update_prices(CommonEquipmentRequest $request)
    {
        $this->commonEquipmentServices->update_prices(user()->common_equipment);
        return response()->json(['info'=>'更新成功'],Response::HTTP_CREATED);
    }
    //常用配置管理添加
    public function store(CommonEquipmentRequest $request)
    {
        CommonEquipment::create($request->all());
        return response()->json(['info'=>'保存意向成功'],Response::HTTP_CREATED);
    }
  //常用配置管理添加页面
    public function create()
    {
       return view('admin.common_equipments.create_and_edit');
    }
    public function add_or_delete(Request $request)
    {
        return $this->machineServices->add_or_delete_user_product();
    }
  //常用配置修改页面
    public function show(CommonEquipment $common_equipment)
    {
        $common_equipment->load('user');
        $user_products=collect([]);
        if(user()){
            user()->user_product()->detach();//删除
            $this->machineServices->set_user_product($common_equipment->common_equipment_product_goods);
            $user_products=$this->machineServices->get_user_product();
        }
        $parameters=$this->commonEquipmentServices->getParameters();
        return view('admin.common_equipments.edit_materiel',compact('user_products','common_equipment','parameters','common_equipment_product_goods','parameters'));
    }
    public function reset(Request $request,CommonEquipment $commonEquipment)
    {
        user()->user_product()->detach();//删除
        $this->machineServices->set_user_product($commonEquipment->common_equipment_product_goods);
        return $this->machineServices->presenterGoods($this->machineServices->get_user_product());
    }

    public function save(Request $request,CommonEquipment $commonEquipment)
    {
        return  $this->machineServices->CommonEquipment_save($commonEquipment);
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
        $order_details=BaseSheetExport::material_details($common_equipment);
        $user_products=collect([]);
        if(user()){
            user()->user_product()->detach();//删除
            $this->machineServices->set_user_product($common_equipment->common_equipment_product_goods);
            $user_products=$this->machineServices->get_user_product();
        }
        return view('member_centers.common_equipments.details',compact('common_equipment','parameters','order_details','user_products'));
    }

  //常用配置管理修改
    public function update(CommonEquipmentRequest $request,  CommonEquipment $common_equipment)
    {
        if($request->has('type') && $request->type == 'edit_name' ){
            $common_equipment->update($request->all());
            return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
        }else{
            $this->commonEquipmentServices->place_an_order($common_equipment);
            return response()->json(['info'=>'下单成功'],Response::HTTP_CREATED);
        }



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