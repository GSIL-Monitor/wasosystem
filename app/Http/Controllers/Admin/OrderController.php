<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderSend;
use App\Exports\AccessoriesOfferSheetExport;
use App\Exports\AssemblyManufacturingSheetExport;
use App\Exports\ContractDocExport;
use App\Exports\DeliverySheetExport;
use App\Exports\MaterialCodeSheetExport;
use App\Exports\UnitQuotationSheetExport;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\Request;
use App\Models\CommonEquipment;
use App\Models\CompleteMachine;
use App\Models\Order;
use App\Models\Admin;
use App\Models\MemberStatus;
use App\Models\Product;
use App\Models\ProductGood;
use App\Models\User;
use App\Services\MessageSendServices;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Services\OrderServices;

class OrderController extends Controller
{
    protected $order;
    protected $orderServices;

    public function __construct(Order $order, OrderServices $orderServices)
    {
        $this->middleware('auth.admin:admin');
        $this->order = $order;
        $this->orderServices = $orderServices;
    }

    //订单管理列表
    public function index(OrderRequest $request)
    {

        $status = $request->get('status') ?? 'all_orders';
        $orders = $this->order->Orders($request, $status)->paginate(20);
        $parameters = $this->orderServices->getParameters();
        return view('admin.orders.index', compact('orders', 'parameters', 'status'));

    }

    //订单管理添加
    public function store(OrderRequest $request)
    {
        Order::create($request->all());
        return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
    }

    //订单管理添加页面
    public function create()
    {
        return view('admin.orders.create_and_edit');
    }

    //订单管理修改页面
    public function show(Order $order)
    {
        $product_goods = $this->orderServices->GetOrderMaterialParameters($order->order_product_goods, $order->user->grade);//获取订单物料
        //将订单物料加入临时表单
        $this->orderServices->AddTemporaryProductGood($product_goods);
        $order_product_goods = $this->orderServices->getTemporaryProductGoods();
        $parts = $order->order_type == 'parts' ? 'parts' : '';
        $parameters = $this->orderServices->getParameters($parts);
        return view('admin.orders.edit_materiel', compact('order', 'parameters', 'order_product_goods', 'parameters'));
    }
    public function orders_for_the_transfer(Request $request, Order $order)
    {
        if ($request->has('user_id') && $request->input('user_id')) {
            $user = User::findOrFail($request->input('user_id'));
            $order->update(['user_id' => $user->id, 'market' => $user->admins->account]);
        }
        if (!empty($order->warehouse_out)) {
            $order->warehouse_out->update(['user_id' => $user->id]);
        }
        $demand = $order->order_demand_management->first();
        if (!empty($demand)) {
            $demand->update(['user_id' => $user->id]);
            foreach ($demand->demand_management_order as $item) {
                $item->update(['user_id' => $user->id, 'market' => $user->admins->account]);
            }
        }
        return success('订单过户成功');
    }
    //订单过户
    public function search(Request $request)
    {
        if ($request->has('username') && $request->input('username')) {
           return  User::where('username', 'like',"%{$request->input('username')}%")->oldest('username')->get(['username', 'id'])->toJson();
        }
        return [];
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

    //订单管理修改物料页面
    public function edit(Order $order)
    {
        $users = User::where('id', '<>', $order->user_id)->oldest('username')->get(['username', 'id'])->toJson();
        //dump($users);
        $parameters = $this->orderServices->getParameters();
        $default_company = $order->user->user_company()->whereDefault(1)->first();
        $company_name = !empty($order->invoice_info) ? $order->company->name : $default_company->name ?? $order->user->unit;
        $company = ['WASO' => '网烁信息', 'SDDZ' => '深度定制', 'CDSL' => '兴圣力'];
        if ($order->order_type != 'parts') {
            $view = "contract_complete_machine";
            $contview = "contract_complete_machine_alert";
            $prompt = '签订合同支付总货款40%（￥' . ($order->total_prices * 0.40) . '.00元）为定金，货到支付总货款30%（￥' . ($order->total_prices * 0.30) . '.00元），余款30%（￥' . ($order->total_prices * 0.30) . '.00元）30天内付清。乙方提供16%增值税发票，甲方通过对公方账户式支付到乙方指定账户。';
            $delivery_goods = '签订合同并收到订金10个工作日内配送到甲方。';

        } else {
            $view = "contract_parts";
            $contview = "contract_parts_alert";
            $prompt = '货到30天内付清全款。';
            $delivery_goods = '签订合同7个工作日内配送到需方公司地址，如需配送至其他指定地址，产生费用由需方承担。。';
        }
        $views = view('admin.orders.doc.' . $contview)->with(['company' => $company, 'delivery_goods' => $delivery_goods, 'prompt' => $prompt, 'type' => 'parts']);
        $html = response($views)->getContent();
        return view('admin.orders.create_and_edit', compact('order', 'parameters', 'html', 'view', 'company_name', 'users'));
    }

    //下载表格和doc文档
    public function export(Order $order, Request $request, Excel $excel)
    {

        if ($request->has('export')) {
            $default_company = $order->user->user_company()->whereDefault(1)->first();
            $company = !empty($order->invoice_info) ? $order->company->name : $default_company->name ?? $order->user->unit;
            $file_name = $company . ' ' . $order->user->nickname . ' ' . $order->user->serial_number . $request->get('export_name') . '.xlsx';
            if ($request->has('view')) {
                $view = view("admin.orders.doc." . $request->get('view'), ['details' => $request, 'company_name' => $company, 'order' => $order, 'default_company' => $default_company]);
                $contents = $view->render();
            }
            switch ($request->get('export')) {
                case 'UnitQuotation': {
                    return $excel->download(new UnitQuotationSheetExport($order), $file_name);
                }
                case 'AccessoriesOffer': {
                    return $excel->download(new AccessoriesOfferSheetExport($order), $file_name);
                }
                case 'AssemblyManufacturing': {
                    return $excel->download(new AssemblyManufacturingSheetExport($order), $file_name);
                }
                case 'MaterialCode': {
                    return $excel->download(new MaterialCodeSheetExport($order), $file_name);
                }
                case 'Delivery': {
                    return $excel->download(new DeliverySheetExport($order), $file_name);
                }
                case 'Contract': {
                    return Doc($contents, $company . '合同' . today()->format('Y-m-d'));
                }
                case 'SignatureForm': {
                    $type = $request->get('type') == 'parts' ? '配件' : '整机';
                    return Doc($contents, $company . '交付验收确认明细单（' . $type . '类）');
                }
                case 'SystemSolution': {

                    return Doc($contents, $company . '深度定制服务器方案' . today()->format('Y-m-d'));
                }
                case 'Publicity': {
                    $pdf_title = $company . '宣传单页';
                    $machine_model = explode('-', $order->machine_model);
                    $complate_machine = CompleteMachine::where('name', 'like', "%{$machine_model[0]}%")->first();
                    $bgImage = $request->get('img');
                    return view('admin.orders.pdf.index', compact('pdf_title', 'order', 'complate_machine', 'bgImage'));
                }
                case 'Measuring': {
                    return Doc($contents, $company . '样品测试合同' . today()->format('Y-m-d'));
                }
            }
        }
    }

    //订单管理修改
    public function update(OrderRequest $request, Order $order)
    {
        if ($request->has('product_good_id')) {
            $this->orderServices->get_product_good($request, $order);
            return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
        } else {
            $this->orderServices->order_update($order);
            event(new OrderSend($order)); //发送钉钉售后不受理
        }
        return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
    }

    //添加修改临时物料
    public function add_modified_temporary_materials(Request $request, Order $order)
    {
        $info = $request->get('status') ?? '修改';
        if ($request->has('total_prices')) { //从临时物料将产品添加到订单物料库
            $this->orderServices->temporary_material_add_to_order_material($request, $order);//添加 修改临时物料
        } else {
            $this->orderServices->get_product_good($request, $order);//添加 修改临时物料
        }
        return response()->json(['info' => $info . '成功'], Response::HTTP_CREATED);
    }

    //订单管理删除
    public function destroy(OrderRequest $request)
    {

        if ($request->has('goodDel')) {
            if ($request->get('goodDel') == 'admins') { //删除临时表里的产品
                $this->orderServices->deleteTemporaryProductGoods($request->get('id'));
            }
            if ($request->get('goodDel') == 'allDelete') { //删除临时表里的产品
                $ids = $this->orderServices->TemporaryProductGoodAllRelatedIds();
                $this->orderServices->deleteTemporaryProductGoods($ids);
            }
        } else {
            Order::destroy($request->get('id'));
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }


}