<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IntegrationRequest;
use App\Models\CompleteMachine;
use App\Models\Integration;
use App\Models\IntegrationCategory;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class IntegrationController extends Controller
{
    protected $integration;
    public function __construct(Integration $integration)
    {
        $this->middleware('auth.admin:admin');
        $this->integration= $integration;
    }
    //软硬一体化列表
    public function index(IntegrationRequest $request)
    {

       $integrations = Integration::latest()->paginate(20);
       return view('admin.integrations.index',compact('integrations'));

    }
    //软硬一体化添加
    public function store(IntegrationRequest $request)
    {
        $integration = Integration::create($request->all()); //添加整机
        $integration->Integration_complete_machines()->sync($request->get('complete_machines')); //将临时表的产品关联到整机
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //软硬一体化添加页面
    public function create()
    {
        $category=IntegrationCategory::latest()->pluck('name','id');
        $complete_machines=CompleteMachine::latest('name')->pluck('name','id');
        $complete_machine=[];
       return view('admin.integrations.create_and_edit',compact('category','complete_machines','complete_machine'));
    }
  //软硬一体化修改页面
    public function edit(Integration $integration)
    {
        $category=IntegrationCategory::latest()->pluck('name','id');
        $complete_machines=CompleteMachine::latest('name')->pluck('name','id');
        $complete_machine= $integration->Integration_complete_machines()->pluck('id');
        return view('admin.integrations.create_and_edit',compact('integration','category','complete_machines','complete_machine'));
    }
  //软硬一体化修改
    public function update(IntegrationRequest $request,  Integration $integration)
    {
        $integration->update($request->all());

        $integration->Integration_complete_machines()->sync($request->get('complete_machines')); //将临时表的产品关联到整机
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //软硬一体化删除
    public function destroy(IntegrationRequest $request)
    {
        Integration::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}