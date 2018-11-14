<?php
namespace App\Http\ViewComposers;
use App\Models\UserNotification;
use App\Services\CompleteMachineServices;
use Illuminate\View\View;
class SiteComposer{
    private $completeMachine;
    public function __construct(CompleteMachineServices $completeMachineServices)
    {
        $this->completeMachine =$completeMachineServices;
    }

    public function compose(View $view)
    {
        $view->with([
            'common_complete_machines'=> $this->completeMachine->complete_machine(),
            'common_solutions'=>$this->completeMachine->solution(),
        ]);
    }

}