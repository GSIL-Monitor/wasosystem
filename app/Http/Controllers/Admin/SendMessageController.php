<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SendMessageRequest;
use App\Http\Requests\Request;
use App\Services\SendMessageServices;
use App\Models\SendMessage;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class SendMessageController extends Controller
{
    protected $send_message;
    protected $send_messageServices;
    public function __construct(SendMessage $send_message,SendMessageServices $send_messageServices)
    {
        $this->middleware('auth.admin:admin');
        $this->send_message= $send_message;
           $this->send_messageServices= $send_messageServices;
    }
    //发送消息列表
    public function index(Request $request)
    {
        $type=$request->get('type') ?? 'email';
        $send_messages =  $this->send_message->with('user')->whereType($type)->latest()->paginate(20);

       return view('admin.send_messages.index',compact('send_messages','type'));

    }
    //发送消息添加
    public function store(SendMessageRequest $request)
    {
        SendMessage::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //发送消息添加页面
    public function create(Request $request)
    {
       return view('admin.send_messages.create_and_edit');
    }
  //发送消息修改页面
    public function edit(SendMessage $send_message)
    {
        return view('admin.send_messages.create_and_edit',compact('send_message'));
    }
  //发送消息修改
    public function update(SendMessageRequest $request,  SendMessage $send_message)
    {
        $send_message->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //发送消息删除
    public function destroy(SendMessageRequest $request)
    {
        SendMessage::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}