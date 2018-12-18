<?php

namespace App\Http\Controllers\Web;
use App\Events\OrderSend;
use App\Models\CompleteMachineFrameworks;
use App\Models\DemandManagement;
use App\Models\Order;
use App\Models\ProductGood;
use App\Services\CompleteMachineServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItOutsourcingController extends Controller
{
    public $completeMachineServices;

    public function __construct(CompleteMachineServices $completeMachineServices)
    {
        $this->completeMachineServices = $completeMachineServices;
    }
    public function index(Request $request)
    {
        $it_outsourcings= ProductGood::where([
            ['jiagou_id',162], ['xilie_id',172], ['status->show',1]
        ])->oldest()->get();
        $its= CompleteMachineFrameworks::with('it_outsourcings')->whereCategory('filtrate')->defaultOrder()->descendantsOf(252)->toTree();

        return view('site.it_outsourcings.index',compact('it_outsourcings','its'));
    }

    public function save(Request $request,ProductGood $productGood)
    {
        return \DB::transaction(function () use($request,$productGood){
            $total_prices=$request->total_price;//获取总价格
            $data['user_id']=user()->id;
            $data['serial_number']='SN'.date('YmdHis',time());
            $data['unit_price']=$total_prices;
            $data['total_prices']=$total_prices;
            $data['order_status']='intention_to_order';
            $data['message_status']='intention_to_order';
            $data['payment_status']='pay_first';
            $data['service_status']=0;
            $data['invoice_type']='vat_special_invoice';
            $data['num']=1;
            $data['parcel_count']=1;
            $data['urgent']=false;
            $data['flow_pic']=false;
            $data['in_common_use']=false;
            $data['market']=user()->admins->account;
            $data['pic']=[];
            $goods[$productGood->id] = ['product_good_num' =>$request->num, 'product_number' => $productGood->product->bianhao, 'product_good_price' =>$request->price];//将物料产品打包到二维数组
            $order=Order::create($data);
            $demand=DemandManagement::create($this->completeMachineServices->initial_demand());
            $order->order_product_goods()->attach($goods);
            $demand->demand_management_order()->attach($order->id);
            event(new OrderSend($order)); //发送钉钉售后不受理
            return $order->id;
        });

  }


}
