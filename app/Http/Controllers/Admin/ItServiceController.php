<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductGoodRequest;
use App\Models\ProductFramework;
use App\Models\ProductGood;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class ItServiceController extends Controller
{
    protected $it_service;
    public function __construct(ProductGood $it_service)
    {
        $this->middleware('auth.admin:admin');
        $this->it_service= $it_service;
    }
    public function index(ProductGoodRequest $request)
    {
        $it_services = ProductGood::with(['series','framework'])->whereJiagouId(162)->whereXilieId(172)->oldest()->paginate(20);

       return view('admin.it_services.index',compact('it_services'));

    }

    public function store(ProductGoodRequest $request)
    {
        ProductGood::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }

    public function create()
    {
        $product_framework =ProductFramework::whereId(162)->pluck('name','id');
        $product_series =ProductFramework::whereParentId(162)->get()->pluck('name','id');
       return view('admin.it_services.create_and_edit',compact('product_framework','product_series'));
    }

    public function edit(ProductGood $it_service)
    {
        $product_framework =ProductFramework::whereId(162)->pluck('name','id');
        $product_series =ProductFramework::whereParentId(162)->get()->pluck('name','id');
        return view('admin.it_services.create_and_edit',compact('it_service','product_framework','product_series'));
    }

    public function update(Request $request, $id)
    {

        $it_service=ProductGood::findOrFail($id);

        $it_service->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }

    public function destroy(ProductGoodRequest $request)
    {
        ProductGood::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}