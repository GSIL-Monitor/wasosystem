<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderSend;
use App\Http\Resources\BannerCollection;
use App\Models\BusinessManagement;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\DemandManagement;
use App\Models\InformationManagement;
use App\Models\Order;
use App\Models\User;
use App\Presenters\CompleteMachineParamenter;
use App\Services\CompleteMachineServices;
use Illuminate\Http\Request;

class CommonApiController extends Controller
{
    //首页banner焦点图
    public function banner(Request $request)
    {
        $banners = BusinessManagement::whereType('banner')->oldest('sort')->get(['field', 'pic']) ?? [];
        return $banners;
    }

    //首页 advantage 优势
    public function advantage(Request $request)
    {
        $advantages[0]['imgUrl'] = env('IMAGES_URL') . json_decode(setting('advantage_members_base'), true)['url'][0];
        $advantages[0]['text'] = str_replace('<br/>', '', setting('advantage_members_base_description'));
        $advantages[1]['imgUrl'] = env('IMAGES_URL') . json_decode(setting('advantage_committeeman'), true)['url'][0];
        $advantages[1]['text'] = str_replace('<br/>', '', setting('advantage_committeeman_description'));
        $advantages[2]['imgUrl'] = env('IMAGES_URL') . json_decode(setting('advantage_soem'), true)['url'][0];
        $advantages[2]['text'] = str_replace('<br/>', '', setting('advantage_soem_description'));
        $advantages[3]['imgUrl'] = env('IMAGES_URL') . json_decode(setting('advantage_stap'), true)['url'][0];
        $advantages[3]['text'] = str_replace('<br/>', '', setting('advantage_stap_description'));
        return $advantages;
    }

    //首页 整机分类
    public function complete_machine_category(Request $request)
    {
        return CompleteMachineFrameworks::whereIn('id', [6, 18, 7, 8, 10, 21, 22, 14])->oldest('order')->get(['id', 'name']);
    }

    //首页 新闻
    public function index_news(Request $request)
    {
        $news = InformationManagement::where([
            ['marketing->choiceness', 1], ['marketing->show', 1]
        ])
            ->latest()->take(4)->get(['id', 'name', 'pic', 'created_at', 'read_count']);
        $arr = [];
        foreach ($news as $key => $item) {
            $created_at = explode(' ', $item->created_at);
            $item['created_at'] = $created_at[0];
            $arr[$key] = $item;
        }
        return $arr;
    }
    //新闻列表
    public function news(Request $request)
    {
        $news = InformationManagement::where([
            ['type', $request->type], ['marketing->show', 1]
        ])
            ->latest()->paginate(10);

        return $news;
    }

    //产品页
    public function products(Request $request, $id)
    {
        $complete_machine_framework = CompleteMachineFrameworks::find($id);
        $servers = CompleteMachine::SiteQuery($complete_machine_framework, $id)->oldest('name')->paginate(10);
        return $servers;
    }

    //全部整机分类和设计师分类
    public function complete_machine_categorys(Request $request)
    {
        return CompleteMachineFrameworks::where([
            ['category', 'framework'], ['parent_id', '<>', null]
        ])->oldest('parent_id')->get(['id', 'name']);
    }

    //整机详情
    public function complete_machine_show(Request $request, $id)
    {
        $user=User::with('favoriteCompleteMachines')->find($request->user_id);
        $completeMachine = CompleteMachine::with('complete_machine_product_goods.product')->findOrFail($id);
        $completeMachine->details = str_replace('/ueditor/php/', env('APP_URL') . '/ueditor/php/', $completeMachine->details);
        $complete_machine_paramenter = new CompleteMachineParamenter();
        $material_detail=[];
        //整机参数
        foreach ($complete_machine_paramenter->material_detail($completeMachine, 'one') as $key => $comparison) {
            if (!empty(implode('', $comparison))){
                $material_detail[$key]=implode('',$comparison);
            }
        }
        $completeMachine->material_detail = $material_detail;
        $completeMachine->collect=false;
        if($user->favoriteCompleteMachines->firstWhere('id',$completeMachine->id)) {
            $completeMachine->collect = true;
        }

        return $completeMachine;
    }
    //整机收藏和取消
    public function collect($id, Request $request)
    {

        $user=User::find($request->user_id);
        if ($user->favoriteCompleteMachines()->find($id)) {
            $user->favoriteCompleteMachines()->detach($id);//如果存在删除
            return [];
        }
        //如果不存在添加
        $user->favoriteCompleteMachines()->attach($id);
        return [];
    }
    //整机下单
    public function intention_to_order(Request $request,$id)
    {
        $user=User::findOrFail($request->user_id);
        $completeMachine = CompleteMachine::with('complete_machine_product_goods')->findOrFail($id);
        $goods = [];
        if($completeMachine->complete_machine_product_goods->isNotEmpty()){
            foreach ($completeMachine->complete_machine_product_goods as $item) {
                $goods[$item->id] = ['product_good_id' => $item->pivot->product_good_id,'product_good_num' => $item->pivot->product_good_num, 'product_number' => $item->pivot->product_number, 'product_good_price' => $item->price[$user->grades->identifying] ];//将物料产品打包到二维数组
            }
        }
        $initial_demand=$this->initial_demand($user);
        return \DB::transaction(function () use ($completeMachine,$user,$goods,$initial_demand){
            $order=Order::create($this->order_data($completeMachine,$user));
            $demand=DemandManagement::create($initial_demand);
            $order->order_product_goods()->attach($goods);
            $demand->demand_management_order()->attach($order->id);
            event(new OrderSend($order)); //发送钉钉售后不受理
            return $order->id;
        });
    }
    public function initial_demand($user)
    {
        //创建需求
        $demand['visitor_details_id']=$user->visitor_details->id;
        $demand['user_id']=$user->id;
        $demand['demand_number']='XQ'.date('YmdHis',time());
        $demand['demand_status']='demand_consult';
        $demand['customer_status']='initial_contact';
        $demand['admin']=$user->admins->id;
        $demand['send']=false;
        $demand['analog_data']=false;
        return $demand;
    }

    public function order_data($completeMachine,$user)
    {

        $data['user_id']=$user->id;
        $data['serial_number']='SN'.date('YmdHis',time());
        $data['machine_model']=$completeMachine->machine_model;
        $data['code']=$completeMachine->code;
        $total_prices=$completeMachine->price[$user->grades->identifying];
        $data['unit_price']=$total_prices;
        $data['total_prices']=$total_prices;
        $data['price_spread']=$completeMachine->price['balance'] ?? 0;
        $data['num']=1;
        $data['order_type']='waso_complete_machine';
        $data['order_status']='intention_to_order';
        $data['message_status']='intention_to_order';
        $data['payment_status']='pay_first';
        $data['service_status']=0;
        $data['invoice_type']='vat_special_invoice';
        $data['parcel_count']=1;
        $data['urgent']=false;
        $data['flow_pic']=false;
        $data['in_common_use']=false;
        $data['market']=$user->admins->account;
        $data['pic']=[];
        return $data;
    }
}