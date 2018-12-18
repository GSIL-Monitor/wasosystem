<?php

namespace App\Http\Controllers\Web;

use App\Exports\BaseSheetExport;
use App\Models\BusinessManagement;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Models\Order;
use App\Models\User;
use App\Models\Video;
use App\Services\CompleteMachineServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServerController extends Controller
{
    public $completeMachineServices;

    public function __construct(CompleteMachineServices $completeMachineServices)
    {
        $this->completeMachineServices = $completeMachineServices;
    }

    public function index(Request $request, $id)
    {
        $complete_machine_framework = CompleteMachineFrameworks::find($id);
        $servers = CompleteMachine::SiteQuery($complete_machine_framework, $id)->oldest('name')->get();
        $type = $servers->first();
        $session = $request->session();
        if ($session->has('complete_machine_type')) {
            if ($session->get('complete_machine_type') != $id) {
                $session->put('complete_machines', []);
                $session->put('complete_machine_type', $id);
            }
        } else {
            $session->put('complete_machine_type', $id);
        }

        return view('site.servers.index', compact('servers', 'complete_machine_framework', 'id', 'type'));
    }

    public function show(Request $request, CompleteMachine $completeMachine)
    {

        $completeMachine
            ->load([
                'information_management_complete_machines',
                'complete_machine_product_goods' => function ($query) {
                    $query->oldest('product_number');
                },
                'complete_machine_product_goods.drive',
                'complete_machine_product_goods.series.drive',
            ]);

        $parent_str = str_before(implode('/', array_filter($completeMachine->jiagou)), '/');
        $like = str_before($completeMachine->name, '-');
        $where = [
            ['machine_model', 'like', "%$like%"],
            ['order_status', '<>', "intention_to_order"]
        ];
        $sales_records = Order::with('user')->where($where)->inRandomOrder()->take(6)->get();
        $sales_srecord_count = Order::where($where)->sum('num');
        $recommends = $completeMachine->with('complete_machine_product_goods')->where([
            ['name', 'like', "%$like%"],
            ['status->recommend', '1']
        ])->inRandomOrder()->take(4)->get();
        $parent = CompleteMachineFrameworks::whereName($parent_str)->firstOrFail();

        $user_products=collect([]);
        if(user()){
              user()->user_product()->detach();//删除
              $this->completeMachineServices->set_user_product($completeMachine->complete_machine_product_goods);
            $user_products=$this->completeMachineServices->get_user_product();
        }
        if($parent->framework_video->first()){
            $video=$parent->framework_video->first();
        }else{
            $video=$completeMachine->complete_machine_video->first() ?? [];
        }
        return view('site.servers.show', compact('completeMachine', 'parent', 'sales_records', 'sales_srecord_count', 'recommends','user_products','video'));
    }

    public function add_or_delete(Request $request)
    {
            return $this->completeMachineServices->add_or_delete_user_product();
    }

    public function reset(Request $request,CompleteMachine $completeMachine)
    {
        user()->user_product()->detach();//删除
        $this->completeMachineServices->set_user_product($completeMachine->complete_machine_product_goods);
        return $this->completeMachineServices->presenterGoods($this->completeMachineServices->get_user_product());
    }

    public function save(Request $request)
    {
       return  $this->completeMachineServices->save();
    }
    public function search(Request $request, $id)
    {
        $complete_machine_framework = CompleteMachineFrameworks::find($id);
        $servers = CompleteMachine::SiteQuery($complete_machine_framework, $id)->oldest('name')->get();
        $html = view('site.servers.product_list', compact('servers'));
        return response($html)->getContent();
    }

    public function collect(CompleteMachine $completeMachine, Request $request)
    {

        if (user()->favoriteCompleteMachines()->find($completeMachine->id)) {

            return [];
        }
        user()->favoriteCompleteMachines()->attach($completeMachine);
        return [];
    }

    public function collectRemove(CompleteMachine $completeMachine, Request $request)
    {
        user()->favoriteCompleteMachines()->detach($completeMachine);
        return ;
    }

    public function comparisonShow(Request $request)
    {
        $comparisons = CompleteMachine::with('complete_machine_product_goods')->whereIn('id', $request->session()->get('complete_machines'))->get();
        $complete_machines = CompleteMachine::where('status->show', '1')->oldest('name')->pluck('name', 'id');

        return view('site.servers.comparision', compact('comparisons', 'complete_machines'));
    }

    public function comparison(CompleteMachine $completeMachine, Request $request)
    {
        $session = $request->session();
        if ($session->has('complete_machines') && count($session->get('complete_machines')) < 4) {
            $old_complete_machines = $session->get('complete_machines') ?? [];
            $new_complete_machines = array_add($old_complete_machines, $completeMachine->id, $completeMachine->id);
            $session->put('complete_machines', $new_complete_machines);
        }
        if (!$session->has('complete_machines') && count($session->get('complete_machines')) < 1) {
            $session->put('complete_machines', [$completeMachine->id => $completeMachine->id]);
        }

        return [];
    }

    public function comparisonRemove(CompleteMachine $completeMachine, Request $request)
    {
        $session = $request->session();
        if ($session->has('complete_machines')) {
            $old_complete_machines = $session->get('complete_machines') ?? [];
            $new_complete_machines = array_except($old_complete_machines, [$completeMachine->id]);
            $session->put('complete_machines', $new_complete_machines);
        }
    }

    public function comparisonAllRemove(Request $request)
    {
        $session = $request->session();
        $session->put('complete_machines', []);
        return [];
    }

}
