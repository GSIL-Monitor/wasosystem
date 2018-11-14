<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MemberRequest;
use App\Models\Admin;
use App\Models\Member;
use App\Models\MemberGrade;
use App\Models\MemberStatus;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    protected $member;

    public function __construct(Member $member)
    {
        $this->middleware('auth.admin:admin');
        $this->member = $member;
    }

    //会员管理列表
    public function index(MemberRequest $request)
    {
        $status = $request->get('status') ?? 'VerifiedMember';
        switch ($status) {
            case 'Unverified': {
                $members = Member::Unverified()->paginate(20);
                break;
            }
            case 'BlockedAccount': {
                $members = Member::BlockedAccount()->paginate(20);
                break;
            }
            default : {
                $members = Member::VerifiedMember()->paginate(20);
            }
        }
        $grades=[];
//        $grades=MemberGrade::get();
//        dump($grades);
        return view('admin.members.index', compact('members', 'status','grades'));

    }

    //会员管理添加
    public function store(MemberRequest $request)
    {
        $data=$request->all();
        $password=$request->get('password');
        if($password !==''){
            $data['password']=bcrypt($password);
            $data['clear_text']=encrypt($password);
        }
        Member::create($data);
        return response()->json(['info' => '添加成功'], Response::HTTP_CREATED);
    }

    //会员管理添加页面
    public function create()
    {
        $parameters=$this->getParameters();
        return view('admin.members.create_and_edit', compact('parameters'));
    }

    //会员管理修改页面
    public function edit(Member $member)
    {
        $parameters=$this->getParameters();
        return view('admin.members.create_and_edit', compact('member','parameters'));
    }

    //会员管理修改
    public function update(MemberRequest $request, Member $member)
    {
        $data=$request->all();
        $password=$request->get('password');
        if($password !==''){
            $data['password']=bcrypt($password);
            $data['clear_text']=encrypt($password);
        }else{
            unset($data['password']);
        }
        $member->update($data);

        return response()->json(['info' => '修改成功'], Response::HTTP_CREATED);
    }

    //会员管理删除
    public function destroy(MemberRequest $request)
    {
        Member::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
    //获取参数
    public function getParameters()
    {
        $arr['admins']=Admin::pluck('name','id');
        $arr['grades']=MemberStatus::whereType('grade')->pluck('name','id');
        $arr['tax_rate']=MemberStatus::whereType('tax_rate')->pluck('name','id');
        $arr['message_type']=config('status.memberInfo');
        $arr['industry']=config('status.memberIndustry');

        return $arr;
    }
}