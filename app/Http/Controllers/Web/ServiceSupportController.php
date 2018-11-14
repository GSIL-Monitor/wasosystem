<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\FeedBackRequest;
use App\Models\BusinessManagement;
use App\Models\CompleteMachineFrameworks;
use App\Models\FeedBack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceSupportController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $complete_machines=CompleteMachineFrameworks::where([
           ['category', 'framework'],['parent_id','<>',null]
        ])->inRandomOrder()->take(3)->get();
      return view('site.service_supports.index',compact('complete_machines'));
    }
    public function service_clause(Request $request,BusinessManagement $service_clause)
    {

        $service_clauses=$service_clause
            ->where([['type','service_directory'],['top',1]])
            ->oldest('sort')
            ->latest('field->type')
            ->get();
        return view('site.service_supports.service_clause',compact('service_clauses','service_clause'));
    }

    public function service_clause_phone(Request $request,BusinessManagement $service_clause)
    {
        $service_clauses=$service_clause
            ->where([['type','service_directory'],['top',1]])
            ->oldest('sort')
            ->latest('field->type')
            ->get();
        return view('site.service_supports.service_clause_phone',compact('service_clauses','service_clause'));
    }
    public function copyright()
    {
        $copyright=BusinessManagement::whereType('copyright')->first();
        return view('site.service_supports.copyright',compact('copyright'));
    }
    public function feedback(Request $request)
    {
        return view('site.service_supports.feedback');
    }

    public function online()
    {
        return view('site.service_supports.online');
    }
    public function feedback_save(Request $request)
    {

        $location=geoip($request->ip());
        $data=$request->all();
        $data['location']=collect($location->toArray())->only(['country','state_name','city','ip'])->all();
         FeedBack::create($data);
       ding()->at([],true)->with('registered_customer')
            ->text('测试信息！！！！ 前台有来自'.
                $location->country.' - '.$location->state_name.' - '.$location->city .
                '用户的反馈建议,请尽快查看并回复！'
            );
        return success('感谢您的反馈建议！我们会尽快回复您！');
    }
}
