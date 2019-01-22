<?php

namespace App\Http\Controllers\Api;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $user=User::findOrFail($request->input('user_id'));
        $notifications=Notification::latest()->get();
        $notifications=$notifications->filter(function ($item) use ($user){
            $grade=$user->grades->identifying;
            return in_array('all',$item->to_user) || in_array($grade,$item->to_user) || in_array($user->id,$item->to_user);
        });
        $all_notification_count=$notifications->count();
        if($user->notification->isEmpty()){
            $user->increment('notification_count',$all_notification_count);
            $user->notification()->attach($notifications->pluck('id'));
        }else{
            $read=$user->notification()->whereState(true)->get();
            $readCount=$read->count();
            $noread=$notifications->diff($user->notification);
            if($user->notification->isNotEmpty()){
                $user->notification()->attach($noread->pluck('id'));
            }
            $user->notification_count=$all_notification_count - $readCount;
        }
       $user_notifications=$user->notification()->paginate(4);
        return $user_notifications;
    }
    public function show(Request $request,$id)
    {
        $notification = Notification::findOrFail($id);
        $user = User::findOrFail($request->input('user_id'));
        $user->notification()->updateExistingPivot($notification->id, ['state' => 1]);
        if ($user->notification_count > 0){
            $user->decrement('notification_count');
        }
        return $notification;
    }
}
