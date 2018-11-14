<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth.admin:admin');
        $this->user_address= $user_address;
    }
    //会员物流地址管理列表
    public function index(UserAddressRequest $request)
    {
        $user = User::find($request->get('user_id'));
        $user_addresses=$user->user_address()->oldest('number')->paginate(20);
       return view('admin.user_addresses.index',compact('user_addresses'));

    }
    //会员物流地址管理添加
    public function store(UserAddressRequest $request)
    {
        UserAddress::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //会员物流地址管理添加页面
    public function create()
    {
       return view('admin.user_addresses.create_and_edit');
    }
  //会员物流地址管理修改页面
    public function edit(UserAddress $user_address)
    {
        return view('admin.user_addresses.create_and_edit',compact('user_address'));
    }
  //会员物流地址管理修改
    public function update(UserAddressRequest $request,  UserAddress $user_address)
    {
        $user_address->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //会员物流地址管理删除
    public function destroy(UserAddressRequest $request)
    {
        UserAddress::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}