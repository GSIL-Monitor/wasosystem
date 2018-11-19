<?php

namespace App\Http\Controllers\Web;
use App\Models\CompleteMachineFrameworks;
use App\Models\ProductGood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItOutsourcingController extends Controller
{
    public function index(Request $request)
    {
        $it_outsourcings= ProductGood::where([
            ['jiagou_id',162], ['xilie_id',172], ['status->show',1]
        ])->oldest()->get();
        $its= CompleteMachineFrameworks::with('it_outsourcings')->whereCategory('filtrate')->defaultOrder()->descendantsOf(252)->toTree();

        return view('site.it_outsourcings.index',compact('it_outsourcings','its'));
    }



}
