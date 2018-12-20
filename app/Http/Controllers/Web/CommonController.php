<?php

namespace App\Http\Controllers\Web;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    public function get_product(Request $request)
    {
        if ($request->has('parent_id')) {
            $product = Product::whereProductId($request->get("parent_id"))->orderBy('name', 'asc')->get(['id', 'name']);
        } else {
            $product = Product::orderBy('bianhao', 'asc')->get(['id', 'title'])->only([15, 16, 17, 18, 19, 24]);
        }
        return $product;
    }

    public function intel(Request $request)
    {
        return view('site.index.page')->with(['name' => 'Intel']);
    }

    public function intelAD(Request $request)
    {
        return view('site.index.page')->with(['name' => 'IntelAD']);
    }

    public function asus(Request $request)
    {
        return view('site.index.page')->with(['name' => 'Asus']);
    }

    public function supermicro(Request $request)
    {
        return view('site.index.page')->with(['name' => 'Supermicro']);
    }

    public function downloadFile(Request $request)
    {
        $File = public_path('storage/'.request()->input('file'));
        $time=today()->format('Y-m-d');
        $FileName= request()->input('name').$time.'.'.str_after(request()->input('file'),'.');
        return response()->download($File,$FileName);
    }

    public function account_setting()
    {
        return view('site.registers.wechat');
    }

    public function account_bind()
    {
        return view('site.registers.wechat_bind');
    }

}