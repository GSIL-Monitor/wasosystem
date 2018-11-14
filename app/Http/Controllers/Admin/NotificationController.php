<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NotificationRequest;
use App\Http\Requests\Request;
use App\Models\MemberStatus;
use App\Models\User;
use App\Models\UserNotification;
use App\Services\NotificationServices;
use App\Models\Notification;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class NotificationController extends Controller
{
    protected $notification;
    protected $notificationServices;
    public function __construct(Notification $notification,NotificationServices $notificationServices)
    {
        $this->middleware('auth.admin:admin');
        $this->notification= $notification;
        $this->notificationServices= $notificationServices;
    }
    //会员公告管理列表
    public function index(Request $request)
    {
        $notifications =  $this->notification->latest()->paginate(20);

       return view('admin.notifications.index',compact('notifications'));

    }
    //会员公告管理添加
    public function store(NotificationRequest $request)
    {
       Notification::create($this->data());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }

    public function data()
    {
        $data=\request()->only(['to_user','content','title']);
        $data['type']='grade';
        $filtered = array_where($data['to_user'], function ($value, $key) {
            return $value == 'all' ;
        });
        if(!empty(\request()->user)){
            $data['type']='user';
            $data['to_user']=\request()->user;
        }
        if(!empty($filtered)){
            $data['type']='all';
        }
        return $data;
    }
  //会员公告管理添加页面
    public function create(Request $request)
    {
        $userGrades=MemberStatus::whereType('grade')->pluck('name','identifying');
        $userGrades->prepend('全部用户', 'all');
        $users=User::oldest('username')->pluck('username','id');
        $notification=[];
       return view('admin.notifications.create_and_edit',compact('userGrades','users','notification'));
    }
  //会员公告管理修改页面
    public function edit(Notification $notification)
    {
        $userGrades=MemberStatus::whereType('grade')->pluck('name','identifying');
        $userGrades->prepend('全部用户', 'all');
        $users=User::oldest('username')->pluck('username','id');
        return view('admin.notifications.create_and_edit',compact('notification','userGrades','users'));
    }
  //会员公告管理修改
    public function update(NotificationRequest $request,  Notification $notification)
    {

        $notification->update($this->data());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //会员公告管理删除
    public function destroy(NotificationRequest $request)
    {
        Notification::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}