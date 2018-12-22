<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\InformationManagement;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class IndexController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth.admin:admin');

    }

    public function index()
    {








//        dd('后台首页，当前用户名：'.auth('admin')->user()->name);



        return view('admin.index.index');
    }

    public function home()
    {
        $order = $this->orderCount();
        return view('admin.index.home', compact('order'));
    }

    public function tiao()
    {
        return view('admin.index.tiao');
    }

    public function userCount()
    {
        $unverified = User::whereGrade('unverified')->count();
        $blocked_account = User::whereGrade('blocked_account')->count();
        $retail_price = User::whereGrade('retail_price')->count();
        $taobao_price = User::whereGrade('taobao_price')->count();
        $member_price = User::whereGrade('member_price')->count();
        $cooperation_price = User::whereGrade('cooperation_price')->count();
        $core_price = User::whereGrade('core_price')->count();
        $cost_price = User::whereGrade('cost_price')->count();
        return view('admin.index.chart.user_chart', compact('unverified', 'blocked_account', 'retail_price'
            , 'taobao_price', 'member_price', 'cooperation_price', 'core_price', 'cost_price'));
    }

    public function selfUserCount()
    {
        $unverified = User::whereAdministrator(admin()->id)->whereGrade('unverified')->count();
        $blocked_account = User::whereAdministrator(admin()->id)->whereGrade('blocked_account')->count();
        $retail_price = User::whereAdministrator(admin()->id)->whereGrade('retail_price')->count();
        $taobao_price = User::whereAdministrator(admin()->id)->whereGrade('taobao_price')->count();
        $member_price = User::whereAdministrator(admin()->id)->whereGrade('member_price')->count();
        $cooperation_price = User::whereAdministrator(admin()->id)->whereGrade('cooperation_price')->count();
        $core_price = User::whereAdministrator(admin()->id)->whereGrade('core_price')->count();
        $cost_price = User::whereAdministrator(admin()->id)->whereGrade('cost_price')->count();
        return view('admin.index.chart.user_chart', compact('unverified', 'blocked_account', 'retail_price'
            , 'taobao_price', 'member_price', 'cooperation_price', 'core_price', 'cost_price'));
    }

    public function orderCount()
    {
        $intention_to_order = Order::whereOrderStatus('intention_to_order')->count();
        $placing_orders = Order::whereOrderStatus('placing_orders')->count();
        $order_acceptance = Order::whereOrderStatus('order_acceptance')->count();
        $in_transportation = Order::whereOrderStatus('in_transportation')->count();
        $arrival_of_goods = Order::whereOrderStatus('arrival_of_goods')->count();
        return view('admin.index.chart.order_chart', compact('intention_to_order', 'placing_orders', 'order_acceptance'
            , 'in_transportation', 'arrival_of_goods'));
    }

    public function selfOrderCount()
    {
        $intention_to_order = Order::whereMarket(admin()->account)->whereOrderStatus('intention_to_order')->count();
        $placing_orders = Order::whereMarket(admin()->account)->whereOrderStatus('placing_orders')->count();
        $order_acceptance = Order::whereMarket(admin()->account)->whereOrderStatus('order_acceptance')->count();
        $in_transportation = Order::whereMarket(admin()->account)->whereOrderStatus('in_transportation')->count();
        $arrival_of_goods = Order::whereMarket(admin()->account)->whereOrderStatus('arrival_of_goods')->count();
        return view('admin.index.chart.order_chart', compact('intention_to_order', 'placing_orders', 'order_acceptance'
            , 'in_transportation', 'arrival_of_goods'));
    }

    public function orderPriceChart()
    {
        $account_paid = Order::where([
            ['order_status', '<>', 'intention_to_order'], ['payment_status', 'account_paid']
        ])->sum('total_prices');
        $no_payment = Order::where([
            ['order_status', 'in_transportation']
        ])->sum('total_prices');
        $total_prices = Order::where([
            ['order_status', '<>', 'intention_to_order']
        ])->sum('total_prices');
        return view('admin.index.chart.order_price_chart', compact('account_paid', 'no_payment', 'total_prices'));
    }

    public function selfOrderPriceChart()
    {
        $account_paid = Order::whereMarket(admin()->account)->where([
            ['order_status', '<>', 'intention_to_order'], ['payment_status', 'account_paid']
        ])->sum('total_prices');
        $no_payment = Order::whereMarket(admin()->account)->where([
            ['order_status', 'in_transportation']
        ])->sum('total_prices');
        $total_prices = Order::whereMarket(admin()->account)->where([
            ['order_status', '<>', 'intention_to_order']
        ])->sum('total_prices');
        return view('admin.index.chart.self_order_price_chart', compact('account_paid', 'no_payment', 'total_prices'));
    }

    public function productGoods()
    {
        $product = Product::with('good')->oldest('bianhao')->get();
        $good = [];
        foreach ($product as $key => $item) {
            $count = $item->good->count();
            $good[$key]['value'] = $count;
            $good[$key]['name'] = $item->title . "({$count})";
        }
        $good_label = collect($good)->pluck('name')->toJson();
        $goods = collect($good)->toJson();
        return view('admin.index.chart.product_goods_chart',
            compact('good_label', 'goods'));
    }

    public function articles()
    {
        $company_dynamic = InformationManagement::whereType('company_dynamic')->count();
        $industry_trends = InformationManagement::whereType('industry_trends')->count();
        $technical_expertise = InformationManagement::whereType('technical_expertise')->count();
        return view('admin.index.chart.articles_chart',
            compact('company_dynamic', 'industry_trends', 'technical_expertise'));
    }

    public function allData()
    {
        $today_users = User::whereAdministrator(admin()->id)->whereDay('created_at', today()->format('d'))->count();
        $mouth_users = User::whereAdministrator(admin()->id)->whereMonth('created_at',today()->format('m'))->count();
        $today_orders = Order::whereMarket(admin()->account)->where('order_status', '<>', 'intention_to_order')->whereDay('created_at', today()->format('d'))->count();
        $mouth_orders = Order::whereMarket(admin()->account)->where('order_status', '<>', 'intention_to_order')->whereMonth('created_at',today()->format('m'))->count();
        $today_return_prices = Order::whereMarket(admin()->account)->where([['order_status', '<>', 'intention_to_order'], ['order_status', 'account_paid']])->whereDay('created_at', today()->format('d'))->sum('total_prices');
        $mouth_return_prices = Order::whereMarket(admin()->account)->where([['order_status', '<>', 'intention_to_order'], ['order_status', 'account_paid']])->whereMonth('created_at',today()->format('m'))->sum('total_prices');

        $label = collect([
            '今日注册会员' . "{$today_users}",
            '本月注册会员' . "{$mouth_users}",
            '今日下单数' . "{$today_orders}",
            '本月下单数' . "{$mouth_orders}",
            '今日回款额' . "{$today_return_prices}",
            '本月回款额' . "{$mouth_return_prices}",
        ])->toJson();
        $data = collect([
            ['value' => $today_users, 'name' => '今日注册会员' . "{$today_users}"],
            ['value' => $mouth_users, 'name' => '本月注册会员' . "{$mouth_users}"],
            ['value' => $today_orders, 'name' => '今日下单数' . "{$today_orders}"],
            ['value' => $mouth_orders, 'name' => '本月下单数' . "{$mouth_orders}"],
            ['value' => $today_return_prices, 'name' => '今日回款额' . "{$today_return_prices}"],
            ['value' => $mouth_return_prices, 'name' => '本月回款额' . "{$mouth_return_prices}"],
        ])->toJson();
        return view('admin.index.chart.all_data_chart',
            compact('label', 'data'));
    }
}
