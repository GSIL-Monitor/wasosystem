<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SelfBuildTerraceRequest;
use App\Models\Product;
use App\Models\ProductFramework;
use App\Models\ProductGood;
use App\Models\ProductParamenter;
use App\Models\SelfBuildTerrace;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Services\SelfBuildTerraceServices;

class SelfBuildTerraceController extends Controller
{
    protected $selfBuildTerraceServices;
    public function __construct(SelfBuildTerraceServices $selfBuildTerraceServices)
    {
        $this->middleware('auth.admin:admin');
        $this->selfBuildTerraceServices=$selfBuildTerraceServices;
    }

    public function index(SelfBuildTerraceRequest $request)
    {
        //自建平台
        $self_build_terraces = ProductGood::whereJiagouId(279)->latest()->paginate(20);
        return view('admin.self_build_terraces.index', compact('self_build_terraces'));

    }

    public function store(SelfBuildTerraceRequest $request)
    {
        if ($request->has('product_good_id') && $request->has('product_good_num')) {
            $this->selfBuildTerraceServices->addTemporaryProductGoods($request);
        } else {
            $goodIds = $this->selfBuildTerraceServices->TemporaryProductGoodAllRelatedIds();
            if ($goodIds) {
                $good = $this->getTemporaryProductGoods();
                $data = $this->selfBuildTerraceServices->get_the_main_board_cabinet_power_parameters($good,$request->get("details"));
                $datas=array_merge($request->all(),$data);
                $good = $this->selfBuildTerraceServices->getTemporaryProductGoods();
                $goods = $this->selfBuildTerraceServices->TemporaryProductGoodParameters($good);//将临时表的产品打包到二维数组
                $self_build_terrace= ProductGood::create($datas); //添加自建平台
                $self_build_terrace->product_goods_self_build_terrace()->sync($goods, false); //将临时表的产品关联到自建平台
                $this->selfBuildTerraceServices->deleteTemporaryProductGoods($goodIds);//删除临时表中的产品
            } else {
                return response()->json(['info' => '添加失败,请添加产品物料'], Response::HTTP_NOT_FOUND);
            }
        }
        return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
    }

    public function create(SelfBuildTerraceRequest $request)
    {
        $arguments = $this->getArguments($request);
        return view('admin.self_build_terraces.create_and_edit', compact('arguments'));
    }

    public function edit(ProductGood $self_build_terrace,SelfBuildTerraceRequest $request)
    {
        $arguments = $this->getArguments($request);

        return view('admin.self_build_terraces.create_and_edit', compact('self_build_terrace','arguments'));
    }

    public function update(SelfBuildTerraceRequest $request, ProductGood $self_build_terrace)
    {

        if ($request->has('product_good_id') && $request->has('product_good_num')) {
            $good_id = $request->get('product_good_id');
            $good_num = $request->get('product_good_num');
            $good = ProductGood::findOrFail($good_id);//如果没有配件 则添加 如果选择了相同的配件  则以当前添加的数量为准
            $self_build_terrace->product_goods_self_build_terrace()->sync([$good_id => ['product_good_num' => $good_num, 'product_number' => $good->product->bianhao]], false);
        } else {
            $good = $self_build_terrace->product_goods_self_build_terrace;
            $data = $this->selfBuildTerraceServices->get_the_main_board_cabinet_power_parameters($good,$request->get("details"));
            $datas=array_merge($request->all(),$data);

            $self_build_terrace->update($datas);
        }
        return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
    }

    public function destroy(SelfBuildTerraceRequest $request)
    {

        if ($request->has('goodDel')) {
            if ($request->get('goodDel') == 'admins') { //删除临时表里的产品
                $this->selfBuildTerraceServices->deleteTemporaryProductGoods($request->get('id'));
            } else {
                //删除自建平台里的产品
                $self_build_terrace = ProductGood::findOrFail($request->get('self_build_terrace_id'));
                $self_build_terrace->product_goods_self_build_terrace()->detach($request->get('id'));
            }
        } else {
            SelfBuildTerrace::destroy($request->get('id'));
        }
        return response()->json(Response::HTTP_NO_CONTENT);
    }

    public function getArguments($request)
    {
        $arr = [];

        $arr['terrace'] = Product::findOrFail(23); //获取平台产品
        $arr['product'] = Product::orderBy('bianhao', 'asc')->pluck('title', 'id'); //获取产品列表
        $arr['terrace_framework'] = ProductFramework::whereId(279)->pluck('name', 'id'); //获取自建平台架构
        $arr['terrace_series'] = ProductFramework::whereParentId(279)->oldest('name')->pluck('name', 'id'); //获取平台系列
        $terrace_type= ProductParamenter::findOrFail(119); //获取平台系列
        $arr['terrace_type'] =$terrace_type->Childrens()->orderBy('name', 'asc')->pluck('name', "name as id");
        return $arr;
    }
}