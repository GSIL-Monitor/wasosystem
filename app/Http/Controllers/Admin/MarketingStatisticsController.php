<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\FundsManagement;
use App\Models\InventoryManagement;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarketingStatisticsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
            if($request->select_date){
                $time=explode(' - ',$request->select_date);
            }else{
                $time=[today()->firstOfMonth(),today()->lastOfMonth()];
            }
        $admins=Admin::oldest('account')->pluck('name','account');
        $orders=Order::with(['markets.funds'=>function($query) use ($time){
            $query->whereBetween('created_at',$time)->where('type','pay');
        }])->when($request->type && !empty($request->type), function ($query) use ($request) {
            $account=explode(',',$request->type);
            if(count($account) >= 2){
                $query->whereIn('market',$account);
            }else{
                $query->whereMarket($request->type);
            }
        })->whereBetween('created_at',$time)->where([
            ['order_status','<>','intention_to_order']
        ])->get(['created_at','total_prices','market','order_status']);



        $order_result = $orders->groupBy([
            function ($item) {
                return $item->market;
            },
        ], $preserveKeys = true)->sortKeys();





        $label = collect([]);
        $month_sales = collect([]);
        $outstanding= collect([]);
        $returned_money= collect([]);
        $transportation = collect([]);
        $proxies = collect([]);
        $test = collect([]);


        foreach ($order_result as $key=>$item) {
            $label->push($admins[$key]);
            $month_sales->push($item->sum('total_prices'));


            $outstanding->push($item->where('payment_status','!=','account_paid')->whereIn('order_status', ['in_transportation', 'arrival_of_goods'])->sum('total_prices'));

            $returned_money->push($item->first()->markets->funds->sum('price'));


//            $good->push($item->sum('good'));
//            $bad->push($item->sum('bad'));
//            $transportation->push($item->sum('return_factory'));
//            $proxies->push($item->sum('proxies'));
//            $test->push($item->sum('test'));
        }
    //    dump($returned_money) ;
        $topData=collect(['当月销售','发出未结','当月回款'])->toJson();
        $label=$label->toJson();
        $data = collect([
            ["name" => '当月销售',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $month_sales
            ],
            ["name" => '发出未结',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $outstanding
            ],
            ["name" => '当月回款',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $returned_money
            ],
//            ["name" => '运输在途',
//                "type" => 'bar',
//                "stack" => '总量',
//                "barMaxWidth" => 30,
//                "data" => $transportation
//            ],
//            ["name" => '代管',
//                "type" => 'bar',
//                "stack" => '总量',
//                "barMaxWidth" => 30,
//                "data" => $proxies
//            ],
//            ["name" => '测试品',
//                "type" => 'bar',
//                "stack" => '总量',
//                "barMaxWidth" => 30,
//                "data" => $test
//            ],
        ])->toJson();
        $select_date=$request->get('select_date');
        $date=$select_date ? explode(' - ',$select_date) : [];
        return view('admin.marketing_statistics.index', compact('label', 'data','date','admins','topData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
