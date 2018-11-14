<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OldOrderRequest;
use App\Models\MemberStatus;
use App\Models\OldOrder;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class OldOrderController extends Controller
{
    protected $old_order;
    public function __construct(OldOrder $old_order)
    {
        $this->middleware('auth.admin:admin');
        $this->old_order= $old_order;
    }
    //旧网站订单管理列表
    public function index(OldOrderRequest $request)
    {
        $old_orders =  $this->old_order->Oldorder($request)->paginate(20);
       return view('admin.old_orders.index',compact('old_orders'));

    }
    //旧网站订单管理添加
    public function store(OldOrderRequest $request)
    {
        OldOrder::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //旧网站订单管理添加页面
    public function create()
    {
       return view('admin.old_orders.create_and_edit');
    }
  //旧网站订单管理修改页面
    public function edit(OldOrder $old_order)
    {
        $services=MemberStatus::whereType('service')->pluck('name');
        return view('admin.old_orders.create_and_edit',compact('old_order','services'));
    }
  //旧网站订单管理修改
    public function update(OldOrderRequest $request,  OldOrder $old_order)
    {
        $old_order->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //旧网站订单管理删除
    public function destroy(OldOrderRequest $request)
    {
        OldOrder::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}