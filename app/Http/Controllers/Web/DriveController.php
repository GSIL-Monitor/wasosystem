<?php

namespace App\Http\Controllers\Web;


use App\Models\CompleteMachine;
use App\Services\FileServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DriveController extends Controller
{
    public function index(Request $request)
    {
        $result=CompleteMachine::with([
            'complete_machine_product_goods.drive',
            'complete_machine_product_goods.series.drive'
        ])->where('status->show',1)->get();
        $complete_machines=FileServices::checkDrive($result);

      return view('site.drives.index',compact('complete_machines'));
    }
    public function show(Request $request,CompleteMachine $completeMachine)
    {
        return view('site.drives.show',compact('completeMachine'));
    }

}
