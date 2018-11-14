<?php

namespace App\Listeners;

use App\Events\DemandCollaboration;
use App\Models\Admin;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCollaborationNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DemandCollaboration  $event
     * @return void
     */
    public function handle(DemandCollaboration $event)
    {

        if(!empty($event->demandManagement->assistant) && $event->demandManagement->send ==false){
            $admin=Admin::whereIn('id',$event->demandManagement->assistant)->get()->implode('phone',',');
            ding()->with('demand_collaboration')->at(explode(',',$admin))
                ->text('测试信息！！！！'.$event->demandManagement->administrator->account."发出需求号：".$event->demandManagement->demand_number.'需要协同完成，收到信息后请尽快配合！');
            $event->demandManagement->update(['send'=>true]);
        }
    }
}
