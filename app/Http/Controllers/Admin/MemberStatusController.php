<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MemberStatusRequest;
use App\Models\MemberStatus;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class MemberStatusController extends Controller
{
    protected $member_status;
    public function __construct(MemberStatus $member_status)
    {
        $this->middleware('auth.admin:admin');
        $this->member_status= $member_status;
    }
    //会员状态管理列表
    public function index(MemberStatusRequest $request)
    {
        $status=$request->get('status') ?? 'grade';
        $member_statuses = MemberStatus::whereType($status)->latest()->paginate(20);

       return view('admin.member_statuses.index',compact('member_statuses','status'));

    }
    //会员状态管理添加
    public function store(MemberStatusRequest $request)
    {
        MemberStatus::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //会员状态管理添加页面
    public function create()
    {
       return view('admin.member_statuses.create_and_edit');
    }
  //会员状态管理修改页面
    public function edit(MemberStatus $member_status)
    {
        return view('admin.member_statuses.create_and_edit',compact('member_status'));
    }
  //会员状态管理修改
    public function update(MemberStatusRequest $request,  MemberStatus $member_status)
    {
        $member_status->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //会员状态管理删除
    public function destroy(MemberStatusRequest $request)
    {
        MemberStatus::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}