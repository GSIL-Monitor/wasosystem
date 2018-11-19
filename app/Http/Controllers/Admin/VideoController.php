<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VideoRequest;
use App\Http\Requests\Request;
use App\Models\CompleteMachine;
use App\Models\CompleteMachineFrameworks;
use App\Services\VideoServices;
use App\Models\Video;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class VideoController extends Controller
{
    protected $video;
    protected $videoServices;
    public function __construct(Video $video,VideoServices $videoServices)
    {
        $this->middleware('auth.admin:admin');
        $this->video= $video;
           $this->videoServices= $videoServices;
    }
    //视频管理列表
    public function index(Request $request)
    {
        $videos =  $this->video->latest()->paginate(20);
       return view('admin.videos.index',compact('videos'));

    }
    //视频管理添加
    public function store(VideoRequest $request)
    {
        $video=Video::create($request->all());
        if(!empty($request->complete_category)){
            $video->framework_video()->sync($request->complete_category,true);
        }
        if(!empty($request->complete_machine)){
            $video->complete_machine_video()->sync($request->complete_machine,true);
        }
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //视频管理添加页面
    public function create(Request $request)
    {
        $complete_categorys=CompleteMachineFrameworks::where([
            ['category','framework'],['parent_id','<>',null]
        ])->pluck('name','id');
        $complete_machines=CompleteMachine::where([
            ['status->show',1]
        ])->latest('name')->pluck('name','id');
//        dump($complete_categorys,$complete_machines);
       return view('admin.videos.create_and_edit',compact('complete_categorys','complete_machines'));
    }
  //视频管理修改页面
    public function edit(Video $video)
    {
        $complete_categorys=CompleteMachineFrameworks::where([
            ['category','framework'],['parent_id','<>',null]
        ])->pluck('name','id');
        $complete_machines=CompleteMachine::where([
            ['status->show',1]
        ])->latest('name')->pluck('name','id');
        return view('admin.videos.create_and_edit',compact('video','complete_categorys','complete_machines'));
    }
  //视频管理修改
    public function update(VideoRequest $request,  Video $video)
    {
        $video->update($request->all());

        if(!empty($request->complete_category)){
            $video->framework_video()->sync($request->complete_category,true);
        }
        if(!empty($request->complete_machine)){
            $video->complete_machine_video()->sync($request->complete_machine,true);
        }
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //视频管理删除
    public function destroy(VideoRequest $request)
    {
        Video::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}