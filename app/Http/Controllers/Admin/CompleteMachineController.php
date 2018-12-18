<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CompleteMachineRequest;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\Product;
use App\Models\ProductGood;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Services\SelfBuildTerraceServices;

class CompleteMachineController extends Controller
{
    protected $selfBuildTerraceServices;

    public function __construct(SelfBuildTerraceServices $selfBuildTerraceServices)
    {
        $this->middleware('auth.admin:admin');
        $this->selfBuildTerraceServices = $selfBuildTerraceServices;
    }

    public function index(CompleteMachineRequest $request)
    {
        $parent_id = $request->get('parent_id') ?? 1;
        if ($request->has('type')) {
            $complete_machines = CompleteMachine::whereParentId($parent_id)->where($request->get('type'), 'like', '%' . $request->get('keyword') . '%')->latest()->paginate(20);
        } else {
            $complete_machines = CompleteMachine::whereParentId($parent_id)->latest()->paginate(20);
        }
        $parent_parameters = CompleteMachineFrameworks::whereNull('parent_id')->pluck('name', 'id')->toArray();
        return view('admin.complete_machines.index', compact('complete_machines', 'parent_parameters', 'parent_id'));

    }

    public function store(CompleteMachineRequest $request)
    {
        if ($request->has('product_good_id') && $request->has('product_good_num')) {
            $this->selfBuildTerraceServices->addTemporaryProductGoods($request);
        } else {
            $goodIds = $this->selfBuildTerraceServices->TemporaryProductGoodAllRelatedIds();
            if ($goodIds) {
                $good = $this->selfBuildTerraceServices->getTemporaryProductGoods();
                $goods = $this->selfBuildTerraceServices->TemporaryProductGoodParameters($good);//将临时表的产品打包到二维数组
                $complete_machine = CompleteMachine::create($request->all()); //添加整机
                $complete_machine->complete_machine_product_goods()->sync($goods,false); //将临时表的产品关联到整机
                $this->selfBuildTerraceServices->deleteTemporaryProductGoods($goodIds);//删除临时表中的产品
            } else {
                return response()->json(['info' => '添加失败,请添加产品物料'], Response::HTTP_NOT_FOUND);
            }
        }
        return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
    }

    public function create(CompleteMachineRequest $request)
    {
        $arguments = $this->getArguments($request);
        return view('admin.complete_machines.create_and_edit', compact('arguments'));
    }

    public function edit(CompleteMachine $complete_machine, CompleteMachineRequest $request)
    {
        $arguments = $this->getArguments($request);
        return view('admin.complete_machines.create_and_edit', compact('complete_machine', 'arguments'));
    }

    public function update(CompleteMachineRequest $request, CompleteMachine $complete_machine)
    {

        if ($request->has('product_good_id') && $request->has('product_good_num')) {

            $good_id = $request->get('product_good_id');
            $good_num = $request->get('product_good_num');
            $good = ProductGood::findOrFail($good_id);//如果没有配件 则添加 如果选择了相同的配件  则以当前添加的数量为准
            $complete_machine->complete_machine_product_goods()->sync([$good_id => ['product_good_num' => $good_num, 'product_number' => $good->product->bianhao]],false);
        } else {
            $complete_machine->update($request->all());
        }
        return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
    }

    public function destroy(CompleteMachineRequest $request)
    {
        if ($request->has('goodDel')) {
            if ($request->get('goodDel') == 'admins') { //删除临时表里的产品
                $this->selfBuildTerraceServices->deleteTemporaryProductGoods($request->get('id'));
            } else {
                //删除整机里的产品
                $complete_machine = CompleteMachine::findOrFail($request->get('complete_machine_id'));
                $complete_machine->complete_machine_product_goods()->detach($request->get('id'));
            }
        } else {
            CompleteMachine::destroy($request->get('id'));
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }

    public function getArguments($request)
    {
        $arr = [];
        $arr['framework'] = CompleteMachineFrameworks::whereCategory('framework')->whereParentId($request->get('parent_id'))->orderBy('order', 'asc')->pluck('name', 'id');//获取架构
        if ($request->get("parent_id") == 2) {  //设计师电脑
            $arr['application'] = CompleteMachineFrameworks::whereCategory("filtrate")->defaultOrder()->descendantsOf($request->get('parent_id'))->toTree();
        } else {//整机
            $arr['application'] = CompleteMachineFrameworks::whereCategory('Application')->whereParentId($request->get('parent_id'))->orderBy('order', 'asc')->pluck('name', 'id'); //获取应用
        }
        $arr['product'] = Product::orderBy('bianhao', 'asc')->pluck('title', 'id'); //获取产品
        return $arr;
    }
}