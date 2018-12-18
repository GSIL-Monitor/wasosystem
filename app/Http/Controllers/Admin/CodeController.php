<?php

namespace App\Http\Controllers\Admin;

use App\Models\InventoryManagement;
use App\Models\Order;
use App\Models\ProcurementPlan;
use App\Models\Product;
use App\Models\SupplierManagement;
use App\Models\WarehouseOutManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpWord\Style\Outline;

class CodeController extends Controller
{
    public function supplie_chart()
    {
        $supplie = SupplierManagement::count();
        $sales_return_count = SupplierManagement::sum('sales_return_count');
        $factory_return_count = SupplierManagement::sum('factory_return_count');
        $label = collect(["供货商{$supplie}", "退货数{$sales_return_count}", "返修数{$factory_return_count}"])->toJson();
        $data = collect([
            ['value' => $supplie, 'name' => "供货商{$supplie}"],
            ['value' => $supplie, 'name' => "退货数{$sales_return_count}"],
            ['value' => $supplie, 'name' => "返修数{$factory_return_count}"]
        ])->toJson();
        return view('admin.index.codeChart.supplie_chart', compact('label', 'data'));
    }

    public function procurement_plans_chart()
    {
        $procurement = ProcurementPlan::whereProcurementStatus('procurement')->count();
        $finish = ProcurementPlan::whereProcurementStatus('finish')->count();
        $unfinished = ProcurementPlan::whereProcurementStatus('unfinished')->count();
        $label = collect(["采购计划{$procurement}", "已入库{$finish}", "入库未完{$unfinished}"])->toJson();
        $data = collect([
            ['value' => $procurement, 'name' => "采购计划{$procurement}"],
            ['value' => $finish, 'name' => "已入库{$finish}"],
            ['value' => $unfinished, 'name' => "入库未完{$unfinished}"]
        ])->toJson();
        return view('admin.index.codeChart.procurement_plans_chart', compact('label', 'data'));
    }

    public function out_chart()
    {
        $out = WarehouseOutManagement::count();
        $finish = WarehouseOutManagement::whereOutStatus('finish')->count();
        $unfinished = WarehouseOutManagement::whereOutStatus('unfinished')->count();
        $outbound = Order::whereOrderStatus('order_acceptance')->doesntHave('warehouse_out')->count();
        $label = collect(["总出库数{$out}", "已出库{$finish}", "出库未完{$unfinished}", "待出库订单{$outbound}"])->toJson();
        $data = collect([
            ['value' => $out, 'name' => "总出库数{$out}"],
            ['value' => $finish, 'name' => "已出库{$finish}"],
            ['value' => $unfinished, 'name' => "出库未完{$unfinished}"],
            ['value' => $outbound, 'name' => "待出库订单{$outbound}"]

        ])->toJson();
        return view('admin.index.codeChart.out_chart', compact('label', 'data'));
    }

    public function inventory_chart()
    {
           $product=Product::oldest('bianhao')->get(['title'])->pluck('title');
          $inventory = InventoryManagement::with('product')->get();
        $result = $inventory->groupBy([
            function ($item) {
                return $item->product->bianhao;
            },
        ], $preserveKeys = true)->sortKeys();
       $label = $product->toJson();
       $new = collect([]);
        $good = collect([]);
        $bad = collect([]);
        $transportation = collect([]);
        $proxies = collect([]);
        $test = collect([]);
        foreach ($result as $key=>$item) {
            $new->push($item->sum('new'));
            $good->push($item->sum('good'));
            $bad->push($item->sum('bad'));
            $transportation->push($item->sum('return_factory'));
            $proxies->push($item->sum('proxies'));
            $test->push($item->sum('test'));
        }
        $data = collect([
            ["name" => '新品',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $new
            ],
            ["name" => '良品',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $good
            ],
            ["name" => '坏货',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $bad
            ],
            ["name" => '运输在途',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $transportation
            ],
            ["name" => '代管',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $proxies
            ],
            ["name" => '测试品',
                "type" => 'bar',
                "stack" => '总量',
                "barMaxWidth" => 30,
                "data" => $test
            ],
        ])->toJson();

        return view('admin.index.codeChart.inventory_chart', compact('label', 'data'));
    }

}
