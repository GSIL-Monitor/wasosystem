<?php

namespace App\Http\Controllers\Web;

use App\Exports\AccessoriesOfferSheetExport;
use App\Exports\BaseSheetExport;
use App\Exports\UnitQuotationSheetExport;
use App\Models\CommonEquipment;
use App\Models\MemberStatus;
use App\Models\Order;
use App\Models\Product;
use App\Services\CompleteMachineServices;
use App\Services\OrderServices;
use App\Services\UserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\Response;

class OrdersController extends Controller
{
    protected $orderServices;
    protected $machineServices;
    protected $order;
    public function __construct(Order $order,OrderServices $orderServices,CompleteMachineServices $machineServices)
    {
        $this->orderServices=$orderServices;
        $this->machineServices=$machineServices;
        $this->order=$order;
    }
    public function index(Request $request)
    {
        $status=$request->get('order_status') ?? 'all_orders';
        $request['type']='serial_number';
        $orders = user()->orders()->with('order_product_goods')->Orders($request, $status)->paginate(20);
        $parameters = $this->orderServices->getParameters();
//        dd($parameters);
        return view('member_centers.orders.index',compact('orders','status','parameters'));
    }
    public function store(Request $request)
    {
        $this->userServices->add_user_parts();
        return success('配件添加成功');
    }
    public function show(Request $request,Order $order,Excel $excel)
    {
        if ($request->has('export')) {
            $default_company = $order->user->user_company()->whereDefault(1)->first();
            $company = !empty($order->invoice_info) ? $order->company->name : $default_company->name ?? $order->user->unit;
            $file_name = $company . ' ' . $order->user->nickname . ' ' . $order->user->serial_number . $request->get('export_name') . '.xlsx';
            switch ($request->get('export')) {
                case 'UnitQuotation': {
                    return $excel->download(new UnitQuotationSheetExport($order), $file_name);
                }
                case 'AccessoriesOffer': {
                    return $excel->download(new AccessoriesOfferSheetExport($order), $file_name);
                }
            }
        }else {
            $order->load('user.user_address', 'user.user_company');
            $service_status = MemberStatus::whereType('service')->get();
            if ($order->order_type != 'parts'){
                $order_details = BaseSheetExport::material_details($order);
             }
            $user_products=collect([]);
            if(user()){
                user()->user_product()->detach();//删除
                $this->machineServices->set_user_product($order->order_product_goods);
                $user_products=$this->machineServices->get_user_product();
            }
            return view('member_centers.orders.intention_details',compact('order','service_status','order_details','user_products'));
        }
    }
    public function reset(Request $request,Order $order)
    {
        user()->user_product()->detach();//删除
        $this->machineServices->set_user_product($order->order_product_goods);
        return $this->machineServices->presenterGoods($this->machineServices->get_user_product());
    }

    public function save(Request $request,Order $order)
    {
        return  $this->machineServices->order_save($order);
    }
    public function edit(Request $request,Order $order)
    {
        $user_products=collect([]);
        $parameters = $this->orderServices->getParameters();
        $service_status=MemberStatus::whereType('service')->get();
        if($order->order_type !='parts'){
            $order_details=BaseSheetExport::material_details($order);
        }

//        dump($parameters,$order);
        return view('member_centers.orders.intention_details',compact('order','parameters','service_status','order_details','user_products'));
    }
    //订单复制
    public function copy(Order $order)
    {
        //初始数据
        $product_goods = $this->orderServices->initial_data($order)->get('product_goods');
        $data = $this->orderServices->initial_data($order);
        $product_goods->pull('price');
        $data->pull('product_goods');
        $new_order = $this->order->create($data->all());//添加复制订单
        $new_order->order_product_goods()->sync($product_goods->all());
        return response()->json(['info' => '复制成功'], Response::HTTP_CREATED);
    }
    //添加常用配置
    public function add_common_equipment(Order $order, Request $request)
    {
        $product_goods = $this->orderServices->initial_data($order)->get('product_goods');
        $data = $this->orderServices->initial_data($order);
        $product_goods->pull('price');
        $data->pull('product_goods');
        $data_arr = $data->all();
        $data_arr['name'] = $request->input('name');
        $data_arr['order_id'] = $order->id;
        $common_equipment = CommonEquipment::create(array_only($data_arr, ['user_id', 'order_id', 'name', 'machine_model', 'code', 'unit_price', 'total_prices', 'old_prices', 'num',
            'order_type', 'service_status', 'invoice_type', 'user_remark', 'company_remark', 'market']));//添加复制订单
        $common_equipment->common_equipment_product_goods()->sync($product_goods->all());
        return success('添加常用配置成功');
    }
    public function update(Request $request,Order $order)
    {
        if($request->has('status') && $request->input('status') == 'cancel_the_order' ){
            $order->update($request->all());
        }else{
            $this->orderServices->order_update($order);
        }

      return success(['info'=>'修改成功','status'=>$request->input('order_status')]);
    }
    public function get_product(Request $request)
    {
        return ProductGood::whereProductId($request->get("parent_id"))->orderBy('name', 'asc')->get(['id', 'name']);
    }



    //删除
    public function destroy(Request $request)
    {

        if(!empty($request->input('condition'))){
            $order=Order::findOrFail($request->input('condition'));
            $order->order_product_goods()->detach($request->input('id'));
        }else{
            Order::destroy($request->get('id'));
        }

        return response()->json(Response::HTTP_OK);
    }
}
