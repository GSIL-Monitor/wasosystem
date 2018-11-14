<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskManagementRequest;
use App\Http\Requests\Request;
use App\Models\Admin;
use App\Models\DivisionalManagement;
use App\Models\HistoricalTaskManagement;
use App\Models\Order;
use App\Services\TaskManagementServices;
use App\Models\TaskManagement;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
class TaskManagementController extends Controller
{
    protected $task_management;
    protected $task_managementServices;
    public function __construct(TaskManagement $task_management,TaskManagementServices $task_managementServices)
    {
        $this->middleware('auth.admin:admin');
        $this->task_management= $task_management;
           $this->task_managementServices= $task_managementServices;
    }
    //销售任务管理列表
    public function index(Request $request)
    {
        $task_managements =  $this->task_management->with('divisional')->latest('goal')->paginate(20);
       return view('admin.task_managements.index',compact('task_managements'));

    }
    //销售任务管理添加
    public function store(TaskManagementRequest $request)
    {
        TaskManagement::create($request->all());
        return response()->json(['info'=>'添加成功'],Response::HTTP_CREATED);
    }
  //销售任务管理添加页面
    public function create(Request $request)
    {
        $divisional=DivisionalManagement::find($request->input('parent_id'));
       return view('admin.task_managements.create_and_edit',compact('divisional'));
    }
    //销售任务管理修改页面
    public function edit(TaskManagement $task_management)
    {
        $task_management->load('divisional');
        return view('admin.task_managements.create_and_edit',compact('task_management'));
    }
    //任务进度
    public function task_progress(Request $request)
    {


        $parent_id=$request->get('parent_id') ?? 88;
        $year =$request->get('year') ??  date('Y',time());
        $mouth =$request->get('mouth') ?? date('m',time()) ;
        $firstYearGroup=Order::oldest()->first();
        $lastYearGroup=Order::latest()->first();
        $firstYear=$firstYearGroup->created_at->format('Y');
        $firstMouth=$firstYearGroup->created_at->format('m');
        $lastYear=$lastYearGroup->created_at->format('Y');
        $lastMouth=$lastYearGroup->created_at->format('m');
        $years=range($firstYear,$lastYear);
        if($firstYear == 2017 && $year==2017){
            $mouths=range($firstMouth,12);
        }else{
            $mouths=range(1,$lastMouth);
        }
        $last=Carbon::createFromDate($year,$mouth)->firstOfMonth();
        dump(  Carbon::createFromDate($year,$mouth)->firstOfMonth(), Carbon::create($year,$mouth,$last->format('d'),23,59,59));
        dump(  Carbon::now()->firstOfMonth(),Carbon::now()->lastOfMonth());
        $divisional_managements = DivisionalManagement::defaultOrder()->descendantsAndSelf(88)->toTree();
        $divisional_management_lists= DivisionalManagement::with(['task','admins.order'=>function($query) use($year,$mouth){
        //    $query->whereYear('created_at', $year)->whereMonth('created_at', $mouth);
        },'admins.funds'=>function($query) use($year,$mouth){
            $query->where('type', 'pay')->whereYear('created_at', $year)->whereMonth('created_at', $mouth);
        }])->defaultOrder()->descendantsAndSelf($parent_id)->toFlatTree();
        if($request->ajax()|| $request->wantsJson()){
//            $view=view('admin.task_managements.table.progress')->with(['divisional_managements'=>$divisional_managements,'parent_id'=>$parent_id,'year'=>$year,'mouth'=>$mouth]);
//            $html=response($view)->getContent();
//            return response()->json($html,Response::HTTP_OK);
        }else{
            return view('admin.task_managements.historical_task',compact('divisional_managements','parent_id','historical_task','year','mouth','years','mouths','divisional_management_lists'));
        }
    }
    //历史任务进度
    public function historical_task(Request $request)
    {
          $parent_id=$request->get('parent_id') ?? 88;
          $year =$request->get('year') ??  date('Y',time());
          $mouth =$request->get('mouth') ?? date('m',time()) ;
          $firstYearGroup=Order::oldest()->first();
          $lastYearGroup=Order::latest()->first();
          $firstYear=$firstYearGroup->created_at->format('Y');
          $firstMouth=$firstYearGroup->created_at->format('m');
          $lastYear=$lastYearGroup->created_at->format('Y');
          $lastMouth=$lastYearGroup->created_at->format('m');
          $years=range($firstYear,$lastYear);
        if($firstYear == 2017 && $year==2017){
            $mouths=range($firstMouth,12);
        }else{
            $mouths=range(1,$lastMouth);
        }
        $divisional_managements = DivisionalManagement::defaultOrder()->descendantsAndSelf(88)->toTree();
        $divisional_management_lists= DivisionalManagement::with(['task','admins.order'=>function($query) use($year,$mouth){
           // $query->whereYear('created_at', $year)->whereMonth('created_at', $mouth);
        },'admins.funds'=>function($query) use($year,$mouth){
            $query->where('type', 'pay')->whereYear('created_at', $year)->whereMonth('created_at', $mouth);
        }])->defaultOrder()->descendantsAndSelf($parent_id)->toFlatTree();
        if($request->ajax()|| $request->wantsJson()){
//            $view=view('admin.task_managements.table.progress')->with(['divisional_managements'=>$divisional_managements,'parent_id'=>$parent_id,'year'=>$year,'mouth'=>$mouth]);
//            $html=response($view)->getContent();
//            return response()->json($html,Response::HTTP_OK);
        }else{
            return view('admin.task_managements.historical_task',compact('divisional_managements','parent_id','historical_task','year','mouth','years','mouths','divisional_management_lists'));
        }

    }
    //营销统计
    public function marketing_statistics(Request $request)
    {
        $parent_id=$request->get('parent_id') ?? 88;
        $year =$request->get('year') ??  date('Y',time());
        $mouth =$request->get('mouth') ?? date('m',time()) ;
        $firstYearGroup=Order::oldest()->first();
        $lastYearGroup=Order::latest()->first();
        $firstYear=$firstYearGroup->created_at->format('Y');
        $firstMouth=$firstYearGroup->created_at->format('m');
        $lastYear=$lastYearGroup->created_at->format('Y');
        $lastMouth=$lastYearGroup->created_at->format('m');
        $years=range($firstYear,$lastYear);
        if($firstYear == 2017 && $year==2017){
            $mouths=range($firstMouth,12);
        }else{
            $mouths=range(1,$lastMouth);
        }
       $divisional_management = DivisionalManagement::defaultOrder()->descendantsAndSelf(88)->toTree();
      $divisional_managements= DivisionalManagement::with(
                            [
                                'task',
                                'admins',
                                'admins.users',
                                'admins.order'=>function($query) use ($year,$mouth){
//                                    return $query
//                                        ->whereYear('created_at',$year)
//                                        ->whereMonth('created_at',$mouth)
//                                        ->where('payment_status','<>','account_paid')
//                                        ->whereIn('order_status', ['in_transportation', 'arrival _of_goods'])
//                                        ;
                                },
                                'admins.funds'=>function($query) use ($year,$mouth){
                                    return $query->whereYear('created_at',$year)->whereMonth('created_at',$mouth)->whereType('pay');
                                },
                                'admins.visitor'=>function($query) use ($year,$mouth){
                                    return $query->whereYear('created_at',$year)->whereMonth('created_at',$mouth);
                                },
                                'admins.demand'=>function($query) use ($year,$mouth) {
                                    return $query->whereYear('created_at',$year)->whereMonth('created_at',$mouth);
                                }])->defaultOrder()
                                 ->descendantsAndSelf($parent_id)->toTree();
        return view('admin.task_managements.marketing_statistics',compact('divisional_management','divisional_managements','parent_id','historical_task','year','mouth','mouths','years'));
    }
  //销售任务管理修改
    public function update(TaskManagementRequest $request,  TaskManagement $task_management)
    {
        $task_management->update($request->all());
         return response()->json(['info'=>'修改成功'],Response::HTTP_CREATED);
    }
  //销售任务管理删除
    public function destroy(TaskManagementRequest $request)
    {
        TaskManagement::destroy($request->get('id'));
        return response()->json(Response::HTTP_NO_CONTENT);
    }
}