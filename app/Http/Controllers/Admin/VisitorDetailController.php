<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VisitorDetailRequest;
use App\Models\Admin;
use App\Models\MemberStatus;
use App\Models\VisitorDetail;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class VisitorDetailController extends Controller
{
    protected $visitor_detail;
    public function __construct(VisitorDetail $visitor_detail)
    {
        $this->middleware('auth.admin:admin');
        $this->visitor_detail= $visitor_detail;
    }
    //客情管理列表
    public function index(VisitorDetailRequest $request)
    {
        $valid=$request->get('valid') ?? 'no';
        $parameters=$this->getParameters();
        $visitor_details =  $this->visitor_detail->VaildVisitorDetails($request,$valid,$parameters)->paginate(20);

       return view('admin.visitor_details.index',compact('visitor_details','valid','parameters'));

    }
    //客情管理添加
    public function store(VisitorDetailRequest $request)
    {
        VisitorDetail::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //客情管理添加页面
    public function create()
    {
        $parameters=$this->getParameters();

       return view('admin.visitor_details.create_and_edit',compact('parameters'));
    }
  //客情管理修改页面
    public function edit(VisitorDetail $visitor_detail)
    {
        $parameters=$this->getParameters();
        return view('admin.visitor_details.create_and_edit',compact('visitor_detail','parameters'));
    }
  //客情管理修改
    public function update(VisitorDetailRequest $request,  VisitorDetail $visitor_detail)
    {

        $visitor_detail->update($request->all());
        if($visitor_detail->user){
            $visitor_detail->user()->update($request->all());//修改会员信息
        }

         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //客情管理删除
    public function destroy(VisitorDetailRequest $request)
    {
        VisitorDetail::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
    //获取参数
    public function getParameters()
    {
        $arr['admins']=Admin::pluck('name','id');
        $arr['source']=MemberStatus::whereType('source')->pluck('name','name as id');
        $arr['grades']=MemberStatus::whereType('grade')->pluck('name','identifying');
        foreach (config('status.userIndustry') as $key=>$value){
            foreach ($value as $v){
                $arr['industry'][$key][$v]=$v;
            }
        }
        return $arr;
    }
}