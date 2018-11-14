<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WeChatApplicationManagementRequest;
use App\Http\Requests\Request;
use App\Models\Admin;
use App\Services\WeChatApplicationManagementServices;
use App\Models\WeChatApplicationManagement;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class WeChatApplicationManagementController extends Controller
{
    protected $we_chat_application_management;
    protected $we_chat_application_managementServices;
    public function __construct(WeChatApplicationManagement $we_chat_application_management,WeChatApplicationManagementServices $we_chat_application_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->we_chat_application_management= $we_chat_application_management;
           $this->we_chat_application_managementServices= $we_chat_application_managementServices;
    }
    //微信应用管理列表
    public function index(Request $request)
    {
        $we_chat_application_managements =  $this->we_chat_application_management->latest()->paginate(20);
//       $agentlists= $this->we_chat_application_managementServices->getAppList();
       return view('admin.we_chat_application_managements.index',compact('we_chat_application_managements'));

    }
    //微信应用管理添加
    public function store(WeChatApplicationManagementRequest $request)
    {
        $data=$request->all();
        $data['secret']=trim($data['secret']);
        WeChatApplicationManagement::create();
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //微信应用管理添加页面
    public function create(Request $request)
    {
       return view('admin.we_chat_application_managements.create_and_edit');
    }
  //微信应用管理修改页面
    public function edit(WeChatApplicationManagement $we_chat_application_management)
    {
        return view('admin.we_chat_application_managements.create_and_edit',compact('we_chat_application_management'));
    }
    //微信应用创建群聊
    public function show(WeChatApplicationManagement $we_chat_application_management)
    {
        $admins=Admin::oldest('account')->pluck('name','account');

        return view('admin.we_chat_application_managements.create_app_chat',compact('we_chat_application_management','admins'));
    }
   //创建群聊
    public function createAppChart(Request $request)
    {
        $this->we_chat_application_managementServices->setSecret($request);
        $this->we_chat_application_managementServices->createAppcChat($request->only([
            'name','owner','userlist'
        ]));
        return response()->json(['info'=>'创建群聊成功'],Response::HTTP_CREATED);
    }

    public function send(Request $request)
    {
        $this->we_chat_application_managementServices->setSecret($request);

    }
  //微信应用管理修改
    public function update(WeChatApplicationManagementRequest $request,  WeChatApplicationManagement $we_chat_application_management)
    {
        $data=$request->all();
        $data['secret']=trim($data['secret']);
        $we_chat_application_management->update($data);
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //微信应用管理删除
    public function destroy(WeChatApplicationManagementRequest $request)
    {
        WeChatApplicationManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}