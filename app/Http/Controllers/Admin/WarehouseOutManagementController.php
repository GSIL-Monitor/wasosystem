<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WarehouseOutManagementRequest;
use App\Http\Requests\Request;
use App\Models\Order;
use App\Models\ProcurementPlan;
use App\Models\User;
use App\Services\WarehouseOutManagementServices;
use App\Models\WarehouseOutManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class WarehouseOutManagementController extends Controller
{
    protected $warehouse_out_management;
    protected $warehouse_out_managementServices;

    public function __construct(WarehouseOutManagement $warehouse_out_management, WarehouseOutManagementServices $warehouse_out_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->warehouse_out_management = $warehouse_out_management;
        $this->warehouse_out_managementServices = $warehouse_out_managementServices;
    }

    //出库管理列表
    public function index(Request $request)
    {
        $status = $request->get('status') ?? 'unfinished';
        $warehouse_out_managements = $this->warehouse_out_management->Condition($status, $request)->latest('updated_at')->paginate(20);
        return view('admin.warehouse_out_managements.index', compact('warehouse_out_managements', 'status'));

    }

    public function checkCode(Request $request)
    {
        $code = $request->input('code');
        $codes = ProcurementPlan::where('code', 'like', "%$code%")->first();
        if ($codes) {
            $products = $codes->products;
            $product_good = $codes->product_goods;
        }
        return response()->json(compact('codes', 'products', 'product_good'));
    }

    //出库管理出库订单列表
    public function out_order(Request $request)
    {
        $out_orders = Order::with(['user',
            'markets',
            'order_product_goods',
            'warehouse_out'
        ])
            ->whereOrderStatus('order_acceptance')->latest()->paginate(20);
        $warehouse_out_model = $this->warehouse_out_managementServices->get_inventory_machine($this->warehouse_out_management);
        return view('admin.warehouse_out_managements.out_order', compact('out_orders', 'warehouse_out_model'));
    }

    //出库管理添加
    public function store(WarehouseOutManagementRequest $request)
    {
        $this->warehouse_out_managementServices->out('', $request);
//        WarehouseOutManagement::create($request->all());
        return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
    }

    //出库管理添加页面
    public function create(Request $request)
    {

        $out_order = Order::with(['markets', 'user'])->findOrFail($request->input('id'));
        return view('admin.warehouse_out_managements.create_and_edit', compact('out_order'));
    }

    //库存整机页面
    public function inventory_machine(Request $request)
    {
        $out_order = Order::findOrFail($request->input('id'));

        $inventory_machine = $this->warehouse_out_management->with('order', 'order.order_product_goods')->whereUserId(994)->whereOutStatus('unfinished')->get();;
        return view('admin.warehouse_out_managements.inventory_machine', compact('out_order', 'inventory_machine'));
    }

    //出库管理添加页面
    public function code_out(Request $request)
    {
        $users = User::oldest('username')->get(['id', 'username', 'nickname'])->pluck_str('-');
        return view('admin.warehouse_out_managements.code_out', compact('users'));
    }

    //出库管理修改页面
    public function edit(WarehouseOutManagement $warehouse_out_management)
    {

        $warehouse_out_management->load('order.order_product_goods', 'codes.product_good', 'codes.product_good.product');
        if ($warehouse_out_management->out_status == 'unfinished') { //如果出库状态是出库未完  然后订单那边有产品的更换或添加
            $this->warehouse_out_managementServices->checkProduct($warehouse_out_management);
            $code_count = $warehouse_out_management->codes->sum('product_good_num');
            if ($code_count != $warehouse_out_management->out_number) {
                $warehouse_out_management->update(['out_number' => $code_count]);//根据条码库中的数量更新出库的确认数量
            }
        }
        return view('admin.warehouse_out_managements.create_and_edit', compact('warehouse_out_management'));
    }

    //出库管理修改页面
    public function show(WarehouseOutManagement $warehouse_out_management)
    {
        $warehouse_out_management->load('codes.product_good', 'codes.product_good.product');
        return view('admin.warehouse_out_managements.code_out', compact('warehouse_out_management'));
    }

    //出库管理修改
    public function update(WarehouseOutManagementRequest $request, WarehouseOutManagement $warehouse_out_management)
    {

        if ($request->input('type')) { //配置应用
            $this->warehouse_out_managementServices->set_inventory_machine($warehouse_out_management, $request);
            return response()->json(['info' => '选用配置成功'], Response::HTTP_CREATED);
        } else {
            $this->warehouse_out_managementServices->out($warehouse_out_management, $request);
            return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
        }


    }

    //出库管理删除
    public function destroy(WarehouseOutManagementRequest $request)
    {
        WarehouseOutManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}