<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class UserAddressController extends Controller
{
    protected $user_address;
    public function __construct(UserAddress $user_address)
    {
        $this->user_address= $user_address;
    }
    //会员物流地址管理列表
    public function index(UserAddressRequest $request)
    {
        $user_addresses=user()->user_address()->latest('default')->oldest('number')->get();
       return view('member_centers.user_addresses.index',compact('user_addresses'));

    }
    //会员物流地址管理添加
    public function store(UserAddressRequest $request)
    {
        if($request->input('id')){
            $user_address=UserAddress::findOrFail($request->input('id'));
            $info=$user_address->update($request->all());
        }else{
            $info=UserAddress::create($request->all());
        }
        return response()->json(['info'=>'保存成功','data'=>$info],Response::HTTP_CREATED);
    }
  //会员物流地址管理修改页面
    public function edit(UserAddress $user_address)
    {
        return $user_address;
    }
  //会员物流地址管理修改
    public function update(UserAddressRequest $request,  UserAddress $user_address)
    {
        \DB::transaction(function () use($user_address){
            $user_address->whereDefault(true)->update(['default'=>false]);
            $user_address->update(['default'=>true]);
        });
        return response()->json(['info'=>'设置成功'],Response::HTTP_CREATED);
    }
  //会员物流地址管理删除
    public function destroy(UserAddressRequest $request)
    {
        UserAddress::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}