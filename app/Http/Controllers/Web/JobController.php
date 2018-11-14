<?php

namespace App\Http\Controllers\Web;
use App\Models\BusinessManagement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index(Request $request)
    {

        $jobs=BusinessManagement::whereType('job')
            ->where(function ($query) use ($request){
                $query->when($request->has('type'),function ($query) use ($request){
                    $query->where('field->type',$request->get('type'));
                });
        })->oldest('field->over')->get();
        return view('site.jobs.index',compact('jobs'));
    }
    public function show(Request $request,BusinessManagement $job)
    {
        return view('site.jobs.show',compact('job'));
    }


}
