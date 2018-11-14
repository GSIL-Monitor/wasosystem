<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductFramework;
use App\Models\Product;
use App\Services\FileServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ProductFrameworkController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $product_id = $request->has('product_id') ? $request->get('product_id') : 23;
        $product_frameworks = ProductFramework::with('Childrens')->condition($product_id)->order()->get();
        $products = Product::order()->get(['id', 'title']);//根据编号获取所有产品
        return view('admin.product_frameworks.index', compact('product_frameworks', 'products', 'product_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.product_frameworks.create_and_edit');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $product_framework = ProductFramework::create($request->all());
        return response()->json(['info' => '添加' . $product_framework->name . '成功', $product_framework], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductFramework $productFramework
     * @return \Illuminate\Http\Response
     */
    public function show(ProductFramework $productFramework)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductFramework $productFramework
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductFramework $productFramework)
    {
        $drives = $productFramework->drive;
        return view('admin.product_frameworks.create_and_edit', compact('productFramework', 'drives'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\ProductFramework $productFramework
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductFramework $productFramework)
    {

        $arr = [];
        if ($request->has('file')) {

            foreach ($request->get('file')['url'] as $key=>$item) {
                $arr[$key]['file']['url'] =$item;
                $arr[$key]['file']['name'] =$request->get('file')['name'][$key];
            }
            $productFramework->drive()->createMany($arr);

            return success('驱动添加成功！');
        }
        return error('没有驱动添加！');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $data = ProductFramework::with('drive','Childrens')->whereIn('id', $request->get('id'))->get(); //查找所有删除对象
        $data->each(function ($item, $key) {
            $item->Childrens()->delete(); //删除子集
            if($item->drive->isNotEmpty()){
                FileServices::DriveDelete($item->drive) ;//删除驱动
            }
            $item->delete();//删除自己
        });
        return response()->json(['info' => '删除成功'], Response::HTTP_OK);
    }
}
