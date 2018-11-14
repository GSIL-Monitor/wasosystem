<?php

namespace App\Http\Controllers\Web;
use App\Models\BusinessManagement;
use App\Models\CompleteMachine;
use App\Models\InformationManagement;
use App\Models\Integration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyWord=$request->input('key');
        $searchs=collect([]);
        if(!empty($keyWord)){
            $integrations=Integration::where(function ($query) use ($keyWord){
                $query->orWhere('name','like',"%{$keyWord}%")
                    ->orWhere('description','like',"%{$keyWord}%");
            })->latest()->get();
            $informationManagements=InformationManagement::where(function ($query) use ($keyWord){
                $query->orWhere('name','like',"%{$keyWord}%")
                    ->orWhere('description','like',"%{$keyWord}%");
            })->latest()->get();
            $completeMachines=CompleteMachine::with('complete_machine_product_goods')->where(function ($query) use ($keyWord){
                $query->orWhere('name','like',"%{$keyWord}%")
                    ->orWhere('application','like',"%{$keyWord}%")
                    ->orWhere('additional_arguments','like',"%{$keyWord}%")
                    ->orWhere('jiagou','like',"%{$keyWord}%");
            })->latest()->get();
//            if($integration->isNotEmpty()){
//                $searchs=$searchs->merge($integration);
//            }
//            if($informationManagement->isNotEmpty()){
//                $searchs=$searchs->merge($informationManagement);
//            }
//            if($completeMachine->isNotEmpty()){
//                $searchs= $searchs->merge($completeMachine);
//            }
        }

        return view('site.searchs.index',compact('integrations','informationManagements','completeMachines'));
    }


}
