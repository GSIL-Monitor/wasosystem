<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeedBackRequest;
use App\Http\Requests\Request;
use App\Services\FeedBackServices;
use App\Models\FeedBack;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class FeedBackController extends Controller
{
    protected $feed_back;
    protected $feed_backServices;
    public function __construct(FeedBack $feed_back,FeedBackServices $feed_backServices)
    {
        $this->middleware('auth.admin:admin');
        $this->feed_back= $feed_back;
           $this->feed_backServices= $feed_backServices;
    }
    //建议反馈列表
    public function index(Request $request)
    {
        $feed_backs =  $this->feed_back->latest()->paginate(20);

       return view('admin.feed_backs.index',compact('feed_backs'));

    }
    //建议反馈添加
    public function store(FeedBackRequest $request)
    {
        FeedBack::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //建议反馈添加页面
    public function create(Request $request)
    {
       return view('admin.feed_backs.create_and_edit');
    }
  //建议反馈修改页面
    public function edit(FeedBack $feed_back)
    {
        return view('admin.feed_backs.create_and_edit',compact('feed_back'));
    }
  //建议反馈修改
    public function update(FeedBackRequest $request,  FeedBack $feed_back)
    {
        $feed_back->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //建议反馈删除
    public function destroy(FeedBackRequest $request)
    {
        FeedBack::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}