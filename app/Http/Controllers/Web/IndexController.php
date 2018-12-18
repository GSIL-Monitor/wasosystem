<?php

namespace App\Http\Controllers\Web;

use App\Models\BusinessManagement;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\InformationManagement;
use App\Models\IntegrationCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;

class IndexController extends Controller
{
    public function index()
    {

        $banners = BusinessManagement::where([
            ['type','banner'],['top',1]
        ])->oldest('sort')->get();
        $complete_machine_works=CompleteMachineFrameworks::where([
            ['category','framework'],['parent_id','<>',null]
        ])->get();

        $complete_machines = CompleteMachine::with('complete_machine_product_goods')->where([
            ['status->show', 1], ['status->recommend', 1]
        ])->limit(12)->get();
        $new_boutiques = InformationManagement::where([
            ['marketing->choiceness', 1], ['marketing->show', 1]
        ])->take(4)->get();
        $new_lists = InformationManagement::where('marketing->show', 1)->take(18)->get();
        $friends = BusinessManagement::where('type', 'friend')->get();
        $integrations=IntegrationCategory::with('child')->get();

        return view('site.index.index', compact('banners', 'complete_machines', 'new_boutiques', 'new_lists', 'friends','complete_machine_works','integrations'));
    }
}
