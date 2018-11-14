<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductParamenter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductParamenterRequest;
use Symfony\Component\HttpFoundation\Response;

class ProductParamenterController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id=$request->has('product_id') ? $request->get('product_id'):23;
        $product_paramenters=ProductParamenter::with(['Childrens','frameWorks_series','paramenters','paramenter','goods'])->whereProductId($product_id)->whereParentId(0)->orderBy('order','asc')->get();

        $products=Product::order()->get(['id','title']);//根据编号获取所有产品
        return view('admin.product_paramenters.index',compact('product_paramenters','products','product_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::with(['Childrens','frameWorks_series','paramenters','goods'])->orderBy('bianhao','asc')->pluck('title','id');
        return view('admin.product_paramenters.create_and_edit',compact('products'));
    }

    /**
     * @param ProductParamenterRequest $paramenterRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductParamenterRequest $paramenterRequest)
    {
        $product_paramenter=ProductParamenter::create($paramenterRequest->all());
        return response()->json(['info'=>"专有项'.$product_paramenter->name.'添加成功",$product_paramenter],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductParamenter  $productParamenter
     * @return \Illuminate\Http\Response
     */
    public function show(ProductParamenter $productParamenter)
    {
        $product_paramenters=ProductParamenter::with(['Childrens','frameWorks_series','paramenters','goods'])->whereParentId($productParamenter->id)->orderBy('order','asc')->get();

        return view('admin.product_paramenters.product_paramenter_value_index',compact('product_paramenters','productParamenter'));
    }

    /**
     * @param ProductParamenter $productParamenter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(ProductParamenter $productParamenter)
    {
        $products=Product::order()->pluck('title','id');
        $product_paramenter_childs=$productParamenter->show_type =='paramenters' ? $productParamenter->paramenter()->get(['id', 'name']) : collect(array(['id'=>'','name'=>'没有选择专有项']));

        return view('admin.product_paramenters.create_and_edit',compact('products','productParamenter','product_paramenter_childs'));
    }

    /**
     * @param ProductParamenterRequest $paramenterRequest
     * @param ProductParamenter $productParamenter
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductParamenterRequest $paramenterRequest, ProductParamenter $productParamenter)
    {
        $productParamenter->update($paramenterRequest->all());
        return response()->json(['info'=>"专有项'.$productParamenter->name.'修改成功",$productParamenter],Response::HTTP_CREATED);
    }

    /**
     * /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $data=ProductParamenter::whereIn('id',$request->get('id'))->get(); //查找所有删除对象
        $data->each(function ($item, $key) {
            $item->Childrens()->delete(); //删除子集
            $item->delete();//删除自己
        });
        return response()->json(['info'=>'删除成功'],Response::HTTP_OK);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Support\Collection   获取对应专有项
     */
    public function get_paramenters(Request $request)
    {
        $product_paramenters=ProductParamenter::whereProductId($request->get("product_id"))->whereParentId(0)->orderBy('order','asc')->get(['id','name']);
        return $product_paramenters;
    }
}
