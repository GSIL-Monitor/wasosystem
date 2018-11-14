<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use App\Models\ProductGood;
use App\Models\UserProduct;
use App\Services\UserServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class PartsController extends Controller
{
    protected $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices=$userServices;
    }
    public function index()
    {
        $products=Product::oldest('bianhao')->pluck('title','id');
        $goods=$this->userServices->member_center_parts();
        return view('member_centers.parts.index',compact('products','goods'));
    }
    public function store(Request $request)
    {
        $this->userServices->add_user_parts();
        return success('配件添加成功');
    }
    public function update(Request $request)
    {
        $this->userServices->create_demand_order();
        return success('生成意向订单成功');
    }
    public function get_product(Request $request)
    {
        if($request->has('parent_id')){
            $product=ProductGood::whereProductId($request->get("parent_id"))->orderBy('name', 'asc')->get(['id', 'name']);
        }else{
            $product=Product::orderBy('bianhao', 'asc')->get(['id', 'title'])->only([15,16,17,18,19,24]);
        }
        return $product;
    }
    //删除
    public function destroy(Request $request)
    {
        user()->user_product()->detach($request->get('id'));
        return response()->json(Response::HTTP_OK);
    }
}
