<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductFramework;
use App\Models\ProductGood;
use App\Models\Product;
use App\Services\FileServices;
use App\Services\ProductGoodServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGoodRequest;
use Symfony\Component\HttpFoundation\Response;
use DB;
class ProductGoodController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id = $request->has('product_id') ? $request->get('product_id') : 23;
        if ($request->has('type')) {
            $product_goods = ProductGood::with(['framework','series'])->condition($product_id)
                ->where($request->get('type'), 'like', '%' . $request->get('keyword') . '%')
                ->orderBy('jiagou_id', 'asc')
                ->orderBy('xilie_id', 'asc')
                ->orderBy('name', 'asc')
                ->latest()
                ->paginate(20);
        }elseif($request->has('equal')){
            //查找相同简称的产品
            $product_goods = ProductGood::with(['framework','series'])->whereRaw('jiancheng in (select jiancheng from product_goods group by jiancheng having COUNT(*)>1)')->where('product_id','=',$product_id)->orderByDesc('jiancheng')->paginate(20);
        }else {
            $product_goods = ProductGood::with(['framework','series'])->condition($product_id)
                ->orderBy('jiagou_id', 'asc')
                ->orderBy('xilie_id', 'asc')
                ->orderBy('name', 'asc')
                ->latest('details->c_h')
                ->paginate(20);
        }


        $products = Product::order()->get(['id', 'title']);//根据编号获取所有产品
        return view('admin.product_goods.index', compact('product_goods', 'products', 'product_id'));
    }
    public function updatePrices(Request $request)
    {
        $product_id = $request->has('product_id') ? $request->get('product_id') : 23;
        if ($request->has('type')) {
            $product_goods = ProductGood::condition($product_id)
                ->where($request->get('type'), 'like', '%' . $request->get('keyword') . '%')
                ->orderBy('jiagou_id', 'asc')
                ->orderBy('xilie_id', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $product_goods = ProductGood::condition($product_id)
                ->orderBy('jiagou_id', 'asc')
                ->orderBy('xilie_id', 'asc')
                ->orderBy('name', 'asc')
                ->get();
        }

        $products = Product::order()->get(['id', 'title']);//根据编号获取所有产品
        return view('admin.product_goods.updatePrices', compact('product_goods', 'products', 'product_id'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $product =Product::with(['framework','Childrens','frameWorks_series','paramenters','goods'])->findOrFail($request->get('product_id'));
        return view('admin.product_goods.create_and_edit', compact('product'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id,Request $request)
    {
        $product_id = $request->has('product_id') ? $request->get('product_id') : 23;
            $product_goods =ProductGood::with(['framework','series'])->onlyTrashed()
                ->condition($product_id)
                ->paginate(20);; //获取软删除数据
        $products = Product::order()->get(['id', 'title']);//根据编号获取所有产品

        return view('admin.product_goods.delete', compact('product_goods', 'products', 'product_id'));
    }
    /**
     * @param ProductGoodRequest $goodRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductGoodRequest $goodRequest)
    {
        $product_good = ProductGood::create($goodRequest->all());
        $product_good->inventory_management()->create($goodRequest->only(["product_id",
        ]));//添加到库存
        return response()->json(['info' => '添加' . $product_good->name . '成功'], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getseries(Request $request)
    {
        if($request->has('get_good')){
            $product = ProductGood::with('inventory_management')->whereProductId($request->get("parent_id"))->orderBy('name', 'asc')->get(['id', 'name']);
            $product_series=[];
            foreach ($product as $key=>$item){
                $product_series[$key]['id']=$item->id;
                $product_series[$key]['name']=$item->name.',新品:'.$item->inventory_management->new.',良品:'.$item->inventory_management->good.',坏货:'.$item->inventory_management->bad;
            }

        }elseif ($request->has('name')){
            $product_series = ProductGood::where('name','like',"%{$request->get("name")}%")->orderBy('name', 'asc')->get(['id', 'name']);
        }else{
            $product_series = ProductFramework::where([
                ['parent_id', '=', $request->get("parent_id")]
            ])->orderBy('name', 'asc')->get(['id', 'name']);
        }
        return $product_series;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductGood $productGood
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGood $productGood)
    {

        $product =Product::with(['paramenters','paramenters'])->findOrFail($productGood->product_id);

        return view('admin.product_goods.create_and_edit', compact('product', 'productGood'));
    }
    public function copy(Request $request,ProductGood $productGood)
    {
      ProductGoodServices::copy($productGood);
      return success('复制成功');
    }
    public function drive(Request $request,ProductGood $productGood)
    {
        $productGood->load('series.drive');
        $drives = $productGood->drive;
        return view('admin.product_goods.drive', compact('productGood','drives'));
    }
    public function drive_add(Request $request, ProductGood $productGood)
    {
        $arr = [];
        if ($request->has('file')) {
            foreach ($request->get('file')['url'] as $key=>$item) {
                $arr[$key]['file']['url'] =$item;
                $arr[$key]['file']['name'] =$request->get('file')['name'][$key];
            }
            $productGood->drive()->createMany($arr);
            return success('驱动添加成功！');
        }
        return error('没有驱动添加！');
    }
    /**
     * @param ProductGoodRequest $goodRequest
     * @param ProductGood $productGood
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductGoodRequest $goodRequest, ProductGood $productGood)
    {
       $productGood->update($goodRequest->all());
        return response()->json(['info' => '修改' . $productGood->name . '成功'], Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        if($request->has('delete')){
            $data =ProductGood::onlyTrashed()->whereIn('id',$request->get('id'))->get(); //查找所有删除对象
            $res=[];
            $data->each(function ($item, $key) use (&$res){
                $pics=json_decode($item->pic,true);
                if(!empty($pics)){
                    FileServices::FileDelete($pics) ;//删除驱动
                }
                if($item->drive->isNotEmpty()){
                    FileServices::DriveDelete($item->drive) ;//删除驱动
                }
                $res[]=$item->forceDelete();//删除自己
            });
        }elseif($request->has('recover')){  //恢复
            $res=ProductGood::onlyTrashed()->whereIn('id',$request->get('id'))->restore();//
        }else{
            $res=ProductGood::destroy($request->get('id'));
        }
        return response()->json($res,Response::HTTP_OK);
   }
}
