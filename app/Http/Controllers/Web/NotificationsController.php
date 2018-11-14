<?php

namespace App\Http\Controllers\Web;



use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class NotificationsController extends Controller
{
    public function index()
    {
        $notifications=Notification::latest()->get();
        $notifications=$notifications->filter(function ($item){
            $grade=user()->grades->identifying;
            return in_array('all',$item->to_user) || in_array($grade,$item->to_user) || in_array(user()->id,$item->to_user);
        });
        $all_notification_count=$notifications->count();
        if(user()->notification->isEmpty()){
            user()->increment('notification_count',$all_notification_count);
            user()->notification()->attach($notifications->pluck('id'));
        }else{
                $read=user()->notification()->whereState(true)->get();
                $readCount=$read->count();
                $noread=$notifications->diff(user()->notification);
                if(user()->notification->isNotEmpty()){
                    user()->notification()->attach($noread->pluck('id'));
                }
                user()->notification_count=$all_notification_count - $readCount;
        }
        $user_notifications=user()->notification()->paginate(5);
        return view('member_centers.notifications.index', compact('user_notifications'));
    }

    public function read(Request $request,Notification $notification)
    {
        user()->notification()->updateExistingPivot($notification->id, ['state'=>1]);
        user()->decrement('notification_count');
        return [];
    }
}
